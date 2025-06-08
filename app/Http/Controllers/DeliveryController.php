<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests; // dùng để lấy dữ liệu từ form
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;
use Illuminate\Support\Facades\Redirect; // dùng để chuyển hướng
use Illuminate\Support\Facades\Session;// 
session_start();
class DeliveryController extends Controller
{
    public function AuthLogin() {
        
        if(Session::get('admin_id') != null) {
            return Redirect::to('admin.dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function update_feeship(Request $request) {
        $data = $request->all();
        $feeship = Feeship::find($data['fee_id']);
        
        $new_fee = trim($data['fee_value'],'.');
        $feeship->fee_feeship = $new_fee;
        $feeship->save();
    }
    public function fetch_feeship() {
        $feeship = Feeship::orderBy('fee_id','DESC')->get();
        $output = '';
        $output .= '<div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>Tên tỉnh</td>
                                    <td>Tên quận huyện</td>
                                    <td>Tên xã phường</td>
                                    <td>Phí vận chuyển (VND)</td>
                                </tr>
                            </thead>
                            <tbody>';
        foreach($feeship as $key => $fee) {
            $output .= '<tr>
                <td>'.$fee->city->nameCity.'</td>
                <td>'.$fee->province->name_quanhuyen.'</td>
                <td>'.$fee->wards->name_xaphuong.'</td>
                <td contenteditable data-fee_edit='.$fee->fee_id.' class="fee_edit_class">'.number_format($fee->fee_feeship,0,',','.').'</td>
            </tr>';
        }
        $output .= '</tbody></table></div>';
        echo $output;
    }
    public function add_feeship(Request $request) {
        $data = $request->all();
        $feeship = new Feeship();
        $feeship->fee_matp = $data['city'];
        $feeship->fee_maqh = $data['province'];
        $feeship->fee_xaid = $data['ward'];
        $feeship->fee_feeship = $data['feeship'];
        $feeship->save();
        
        
    }
    public function get_delivery(Request $request) {
        $data = $request->all();
        $output = '';
        if($data['action'] == 'nameCity') {
            $selectProvince = Province::where('matp',$data['ma_id'])->orderBy('maqh','ASC')->get();
            $output .= "<option value='0'>---Chọn quận huyện---</option>";
            foreach($selectProvince as $key => $qh) {
                $output .="<option value='".$qh->maqh."'>".$qh->name_quanhuyen."</option>";
            }
        } else {
            $selectWards = Wards::where('maqh',$data['ma_id'])->orderBy('xaid','ASC')->get();
            $output .= "<option value='0'>---Chọn xã phường---</option>";
            foreach($selectWards as $key => $xp) {
                $output .= "<option value='".$xp->xaid."'>".$xp->name_xaphuong."</option>";
            }
        }
        echo $output;
    }
    public function delivery() {
        $this->AuthLogin();
        $cityData = City::orderBy('matp','ASC')->get();
        
        return view('admin.delivery.add_delivery')->with(compact('cityData'));
    }
    public function addDelivery() {
        $cityData = City::all(); // Lấy danh sách thành phố
        return view('admin.delivery.add_delivery', compact('cityData'));
    }
    public function allDelivery() {
        $feeships = FeeShip::with(['city', 'district', 'ward'])->get(); // Lấy danh sách giá vận chuyển
        return view('admin.delivery.all_delivery', compact('feeships'));
    }
    public function saveDelivery(Request $request) {
        $feeship = new FeeShip();
        $feeship->fee_matp = $request->nameCity;
        $feeship->fee_maqh = $request->nameProvince;
        $feeship->fee_xaid = $request->nameWards;
        $feeship->fee_feeship = $request->feeship;
        $feeship->save();
    
        Session::put('message', 'Thêm giá vận chuyển thành công');
        return redirect()->route('add.delivery');
    }
    public function deleteDelivery($id) {
        FeeShip::find($id)->delete();
        Session::put('message', 'Xóa giá vận chuyển thành công');
        return redirect()->route('all.delivery');
    }
    public function editDelivery($id) {
        $feeship = FeeShip::findOrFail($id);
        $cityData = City::all(); // Lấy danh sách thành phố
        $provinceData = Province::where('matp', $feeship->fee_matp)->get(); // Lấy danh sách quận huyện
        $wardData = Wards::where('maqh', $feeship->fee_maqh)->get(); // Lấy danh sách xã phường
    
        return view('admin.delivery.edit_delivery', compact('feeship', 'cityData', 'provinceData', 'wardData'));
    }
    public function updateDelivery(Request $request, $id) {
        $data = $request->validate([
            'fee_matp' => 'required',
            'fee_maqh' => 'required',
            'fee_xaid' => 'required',
            'fee_feeship' => 'required|numeric',
        ]);
    
        $feeship = Feeship::findOrFail($id);
        $feeship->update($data);
    
        return redirect()->route('all.delivery')->with('message', 'Cập nhật phí vận chuyển thành công!');
    }
    
                    
}
