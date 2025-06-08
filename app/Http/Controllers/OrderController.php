<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // dùng để thao tác với csdl.
use App\Http\Requests; // dùng để lấy dữ liệu từ form
use Illuminate\Support\Facades\Redirect; // dùng để chuyển hướng
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\City;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;
use App\Rules\Captcha;
use Illuminate\Support\Facades\Session;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;
use PDF;

class OrderController extends Controller
{
    public function update_qty(Request $request){
		$data = $request->all();
		$order_detail = OrderDetail::where('product_id',$data['order_product_id'])->where('order_code',$data['order_code'])->first();
		$order_detail->product_sales_quantity = $data['order_qty'];
		$order_detail->save();
	}
    public function update_order_qty(Request $request){
		//update order
		$data = $request->all();
      
		$order = Order::find($data['order_id']);
		$order->order_status = $data['order_status'];
		$order->save();
		if($order->order_status==2){
			foreach($data['order_product_id'] as $key => $product_id){
				
				$product = Product::find($product_id);
				$product_quantity = $product->product_quantity;
				$product_sold = $product->product_sold;
				foreach($data['quantity'] as $key2 => $qty){
						if($key==$key2){
								$pro_remain = $product_quantity - $qty;
								$product->product_quantity = $pro_remain;
								$product->product_sold = $product_sold + $qty;
								$product->save();
						}
				}
			}
		}elseif($order->order_status!=2 && $order->order_status!=3){
			foreach($data['order_product_id'] as $key => $product_id){
				
				$product = Product::find($product_id);
				$product_quantity = $product->product_quantity;
				$product_sold = $product->product_sold;
				foreach($data['quantity'] as $key2 => $qty){
						if($key==$key2){
								$pro_remain = $product_quantity + $qty;
								$product->product_quantity = $pro_remain;
								$product->product_sold = $product_sold - $qty;
								$product->save();
						}
				}
			}
		}


	}
    public function print_order($checkout_code)
    {
        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }
    
    public function print_order_convert($checkout_code)
    {
        $order_detail = OrderDetail::where('order_code', $checkout_code)->get();
        $order = Order::where('order_code', $checkout_code)->get();
    
        foreach ($order as $key => $ord) {
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
        }
    
        $customer = Customer::where('customer_id', $customer_id)->first();
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();
        $order_detail_product = OrderDetail::with('product')->where('order_code', $checkout_code)->get();
    
        foreach ($order_detail_product as $key => $order_d) {
            $product_coupon = $order_d->product_coupon;
        }
    
        if ($product_coupon != 'no') {
            $coupon = Coupon::where('coupon_code', $product_coupon)->first();
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
    
            if ($coupon_condition == 1) {
                $coupon_echo = $coupon_number . '%';
            } elseif ($coupon_condition == 2) {
                $coupon_echo = number_format($coupon_number, 0, ',', '.') . 'đ';
            }
        } else {
            $coupon_condition = 2;
            $coupon_number = 0;
            $coupon_echo = '0';
        }
    
        $output = '
        <style>
            body {
                font-family: DejaVu Sans, sans-serif;
                line-height: 1.2;
                margin: 20px;
            }
            h2, h4 {
                text-align: center;
                margin: 5px 0;
            }
            p {
                margin: 5px 0;
                font-size: 14px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }
            th, td {
                padding: 10px;
                border: 1px solid #000;
                text-align: left;
                font-size: 13px;
            }
            th {
                background-color: #f9f9f9;
                text-transform: uppercase;
            }
            .table-styling {
                margin-bottom: 15px;
            }
            .total-info p {
                margin: 2px 0;
                font-weight: bold;
            }
            .signature {
                text-align: center;
                padding-top: 40px;
                font-size: 14px;
            }
        </style>
        
        <h2>Công ty TNHH một thành viên HandmadeShop</h2>
        <h4>Độc lập - Tự do - Hạnh phúc</h4>
        
        <p><strong>Người đặt hàng:</strong></p>
        <table class="table-styling">
            <thead>
                <tr>
                    <th>Tên khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>' . $customer->customer_name . '</td>
                    <td>' . $customer->customer_phone . '</td>
                    <td>' . $customer->customer_email . '</td>
                </tr>
            </tbody>
        </table>
        
        <p><strong>Thông tin giao hàng:</strong></p>
        <table class="table-styling">
            <thead>
                <tr>
                    <th>Tên người nhận</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Ghi chú</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>' . $shipping->shipping_name . '</td>
                    <td>' . $shipping->shipping_address . '</td>
                    <td>' . $shipping->shipping_phone . '</td>
                    <td>' . $shipping->shipping_email . '</td>
                    <td>' . $shipping->shipping_notes . '</td>
                </tr>
            </tbody>
        </table>
        
        <p><strong>Chi tiết đơn hàng:</strong></p>
        <table class="table-styling">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Mã giảm giá</th>
                    <th>Phí ship</th>
                    <th>Số lượng</th>
                    <th>Giá sản phẩm</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>';
        
        $total = 0;
        
        foreach ($order_detail_product as $key => $product) {
            $subtotal = $product->product_price * $product->product_sales_quantity;
            $total += $subtotal;
        
            $product_coupon_display = $product->product_coupon !== 'no' ? $product->product_coupon : 'Không mã';
        
            $output .= '
                <tr>
                    <td>' . $product->product_name . '</td>
                    <td>' . $product_coupon_display . '</td>
                    <td>' . number_format($product->product_feeship, 0, ',', '.') . 'đ</td>
                    <td>' . $product->product_sales_quantity . '</td>
                    <td>' . number_format($product->product_price, 0, ',', '.') . 'đ</td>
                    <td>' . number_format($subtotal, 0, ',', '.') . 'đ</td>
                </tr>';
        }
        
        if ($coupon_condition == 1) {
            $total_after_coupon = ($total * $coupon_number) / 100;
            $total_coupon = $total - $total_after_coupon;
        } else {
            $total_coupon = $total - $coupon_number;
        }
        
        $output .= '
            <tr>
                <td colspan="6" class="total-info">
                    <p>Tổng giảm: ' . $coupon_echo . '</p>
                    <p>Phí ship: ' . number_format($product->product_feeship, 0, ',', '.') . 'đ</p>
                    <p>Thanh toán: ' . number_format($total_coupon + $product->product_feeship, 0, ',', '.') . 'đ</p>
                </td>
            </tr>
        </tbody>
        </table>
        
          <p><strong>Ký tên:</strong></p>
        <p style="text-align: center; padding-top: 30px;">Người lập phiếu ______________________ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Người nhận _______________________</p>';
        
        return $output;
        
    }
  
    public function view_order($order_code) {
        $order_detail = OrderDetail::with('product')->where('order_code',$order_code)->get();
		$order = Order::where('order_code',$order_code)->get();
		foreach($order as $key => $ord){
			$customer_id = $ord->customer_id;
			$shipping_id = $ord->shipping_id;
			$order_status = $ord->order_status;
		}
		$customer = Customer::where('customer_id',$customer_id)->first();
		$shipping = Shipping::where('shipping_id',$shipping_id)->first();

		$order_detail_product = OrderDetail::with('product')->where('order_code', $order_code)->get();

		foreach($order_detail_product as $key => $order_d){

			$product_coupon = $order_d->product_coupon;
		}
		if($product_coupon != 'no'){
			$coupon = Coupon::where('coupon_code',$product_coupon)->first();
			$coupon_condition = $coupon->coupon_condition;
			$coupon_number = $coupon->coupon_number;
		}else{
			$coupon_condition = 2;
			$coupon_number = 0;
		}
		
		return view('admin.view_order')->with(compact('order_detail','customer','shipping','order_detail','coupon_condition','coupon_number','order','order_status'));
    }
    
    public function manage_order() {
        // $this->AuthLogin();
        $order = Order::orderby('created_at','DESC')->get();
        return view('admin.manage_order')->with(compact('order'));
    }
}