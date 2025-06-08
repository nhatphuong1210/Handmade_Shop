<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;// dùng để thao tác với csdl.
use Illuminate\Support\Facades\Session; // dùng để  lưu tạm các message sau khi thực hiện một công việc gì đó.
use App\Http\Requests; // dùng để lấy dữ liệu từ form
use Illuminate\Support\Facades\Redirect; // dùng để chuyển hướng
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Coupon;
session_start();
class CartController extends Controller
{
    //
    public function save_cart(Request $request) {
    $productId = $request->productID;
    $quanlity = $request->quanlity;
    $product = DB::table('tbl_product')->where('product_id', $productId)->first();
    
    $data['id'] = $productId;
    $data['qty'] = $quanlity;
    $data['name'] = $product->product_name;
    $data['price'] = $product->product_price;
    $data['weight'] = $product->product_price; //fake
    $data['options']['image'] = $product->product_image;

    // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
    $existingProduct = Cart::search(function ($cartItem, $rowId) use ($productId) {
        return $cartItem->id == $productId; // Kiểm tra sản phẩm dựa trên id
    });

    if ($existingProduct->isNotEmpty()) {
        // Nếu sản phẩm đã có trong giỏ, cập nhật số lượng
        $rowId = $existingProduct->first()->rowId;
        Cart::update($rowId, $quanlity); // Cập nhật số lượng
    } else {
        // Nếu sản phẩm chưa có trong giỏ, thêm mới
        Cart::add($data);
    }

    return Redirect::to('view-cart');
}


    public function view_cart(Request $request) {
        $meta_title = "Thông tin giỏ hàng";
        $meta_desc = "Trang Thông tin giỏ hàng của bạn";
        $meta_keywords = "giỏ hàng HandmadeShop, HandmadeShop cart";
        $meta_canonical = $request->url();
        $image_og = "";
        
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $branch_product = DB::table('tbl_branch_product')->where('branch_status','1')->orderby('branch_id','desc')->get();
        return view('pages.cart.view_cart')->with('category_product',$cate_product)->with('branch_product',$branch_product)
        ->with('meta_title',$meta_title)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_canonical',$meta_canonical)
        ->with('image_og',$image_og);
    }
    public function delete_row_cart($rowId) {
        Cart::update($rowId,0);
        return Redirect::to('/view-cart');
    }
    public function update_cart_quanlity(Request $request) {
        $rowId = $request->rowIDChangeQty;
        $qty = $request->quantity_change;
        Cart::update($rowId,$qty);
        return Redirect::to('/view-cart');
    }
    // cart ajax
    public function add_cart_ajax(Request $request) {
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0,26), 5);
        
        // Lấy giỏ hàng từ session
        $cart = Session::get('cart');
        
        // Kiểm tra xem giỏ hàng có dữ liệu không
        if ($cart) {
            $isAvailable = 0;
            
            // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
            foreach ($cart as $key => $product) {
                if ($product['product_id'] == $data['cart_product_id']) {
                    // Nếu có thì cộng thêm số lượng
                    $cart[$key]['product_qty'] += $data['cart_product_qty'];
                    $isAvailable++;
                    break;
                }
            }
            
            // Nếu sản phẩm chưa có trong giỏ, thêm mới
            if ($isAvailable == 0) {
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_id' => $data['cart_product_id'],
                    'product_name' => $data['cart_product_name'],
                    'product_image' => $data['cart_product_image'],
                    'product_price' => $data['cart_product_price'],
                    'product_qty' => $data['cart_product_qty'],
                );
            }
        } else {
            // Nếu giỏ hàng chưa có, tạo mới và thêm sản phẩm vào giỏ
            $cart[] = array(
                'session_id' => $session_id,
                'product_id' => $data['cart_product_id'],
                'product_name' => $data['cart_product_name'],
                'product_image' => $data['cart_product_image'],
                'product_price' => $data['cart_product_price'],
                'product_qty' => $data['cart_product_qty'],
            );
        }
    
        // Lưu giỏ hàng vào session
        Session::put('cart', $cart);
        Session::save();  // Đảm bảo session được lưu lại
    }
    
    public function gio_hang(Request $request) {
        // Session::flush();
        $meta_title = "Thông tin giỏ hàng";
        $meta_desc = "Trang Thông tin giỏ hàng của bạn";
        $meta_keywords = "giỏ hàng handmade, handmade cart";
        $meta_canonical = $request->url();
        $image_og = "";
        
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $branch_product = DB::table('tbl_branch_product')->where('branch_status','1')->orderby('branch_id','desc')->get();
        return view('pages.cart.view_cart_ajax')->with('category_product',$cate_product)->with('branch_product',$branch_product)
        ->with('meta_title',$meta_title)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_canonical',$meta_canonical)
        ->with('image_og',$image_og);
    }
    public function del_cart($session_id) {
        $cart = Session::get('cart');
        if($cart == true) {
            foreach($cart as $key => $val) {
                if($val['session_id'] == $session_id){
                    unset($cart[$key]);
                    Session::put('cart',$cart);
                }
            }
            return redirect()->back()->with('message','Xóa sản phẩm thành công');
        } else {
            return redirect()->back()->with('message','Xóa sản phẩm không thành công');
        }
    }
    public function update_cart(Request $request) {
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart == true) {
        foreach($data['quantity_change'] as $sessionId => $quanlityValue) {
            foreach($cart as $key => $val) {
                if($sessionId == $val['session_id']) {
                    $cart[$key]['product_qty'] = $quanlityValue;
                }
            }
        }
        }
        Session::put('cart',$cart);
        return redirect()->back()->with('message','Cập nhật số lượng thành công');
    }
    public function delete_cart() {
        $cart = Session::get('cart');
        if($cart == true) {
            Session::forget('cart');
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa hết giỏ hàng thành công');
        }
    }
    public function check_coupon(Request $request) {
        $data = $request->all();
        $coupon = Coupon::where('coupon_code',$data['coupon_code'])->first();
        if($coupon) {
            if($coupon->count() > 0) {
              $coupon_session = Session::get('coupon');
              if($coupon_session) {
                $isAvaliableCoupon = 0;
                if($isAvaliableCoupon == 0) {
                    $coupons[] = array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number' => $coupon->coupon_number,
                    );
                    Session::put('coupon',$coupons);
                }
              } else {
                  $coupons[] = array(
                      'coupon_code' => $coupon->coupon_code,
                      'coupon_condition' => $coupon->coupon_condition,
                      'coupon_number' => $coupon->coupon_number,
                  );
                  Session::put('coupon',$coupons);
              }
              Session::save();
              return redirect()->back()->with('message','Áp dụng mã giảm giá thành công');
            }
            
        } else {
            return redirect()->back()->with('message','Mã giảm giá không đúng');
        }
    }
}
