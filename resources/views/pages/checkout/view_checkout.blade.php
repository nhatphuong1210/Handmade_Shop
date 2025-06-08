<?php
use Illuminate\Support\Facades\Session;
?>
@extends('layout')
@section("title","Trang thanh toán")
@section("content")
<style>
/* Thêm gradient background cho form */
.register-req {
    background: linear-gradient(to right, #6a11cb, #2575fc);
    color: #fff;
    padding: 20px;
	margin-left: 50px;
	width: 80%;
	text-align: center;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.shopper-informations .bill-to form input,
.shopper-informations .bill-to form textarea,
.shopper-informations .bill-to form select {
    border: 1px solid #ddd;
    padding: 12px 15px;
    margin: 10px 50px;
    width: 80%;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease-in-out;
}

.shopper-informations .bill-to form input:focus,
.shopper-informations .bill-to form textarea:focus,
.shopper-informations .bill-to form select:focus {
    border-color: #2575fc;
    box-shadow: 0 0 8px rgba(37, 117, 252, 0.5);
    outline: none;
}

/* Hiệu ứng hover cho nút xác nhận */
.confirm-order {
    background-color: #2575fc;
    border: none;
    padding: 12px 20px;
    color: #fff;
    font-size: 16px;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.confirm-order:hover {
    background-color: #6a11cb;
}

/* Cập nhật cho bảng sản phẩm */
.table-condensed {
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.table-condensed thead {
    background: linear-gradient(to right, #6a11cb, #2575fc);
    color: #fff;
}

.table-condensed tbody tr:hover {
    background-color: #f7f7f7;
    transform: scale(1.01);
    transition: all 0.3s ease-in-out;
}

/* Tạo các nút thanh toán đẹp */
.check_out {
    display: inline-block;
    background-color: #04aa6d;
    color: #fff;
    padding: 12px 20px;
    border-radius: 6px;
    text-decoration: none;
    text-align: center;
    width: 50%;
	margin-left: 210px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
}

.check_out:hover {
    background-color: #6a11cb;
}

.submitQty {
    background-color: #3a396c;
    color: white;
    border: none;
    padding: 12px 20px;
    text-align: center;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
}

.submitQty:hover {
    background-color: #807ab5;
}

/* Hiệu ứng cho các ô chọn */
.choose {
    background-color: #f1f1f1;
    border: 1px solid #ddd;
    padding: 12px 15px;
    border-radius: 6px;
    transition: all 0.3s ease-in-out;
}

.choose:hover {
    background-color: #ffffff;
    color: #000000;
}

/* Thêm hiệu ứng cho các ô input số lượng */
.cart_quantity_button input {
    background-color: #f1f1f1;
    border: 1px solid #ddd;
    padding: 10px;
    width: 50px;
    border-radius: 6px;
    text-align: center;
    transition: all 0.3s ease-in-out;
}

.cart_quantity_button input:focus {
    border-color: #2575fc;
    outline: none;
}

/* Hiệu ứng cho các thông báo */
.alert {
    padding: 20px;
    background-color: #f44336;
    color: white;
    border-radius: 6px;
    margin-bottom: 15px;
    font-weight: bold;
}

.alert-danger {
    background-color: #ff5722;
}

.alert-info {
    background-color: #2196f3;
}

.table-condensed {
    width: 100%;
    border-collapse: collapse;  /* Hợp nhất các viền ô lại */
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
/* Đặt kích thước cho ảnh */
.table-condensed td.cart_product img {
    border-radius: 5px; /* Bo góc hình ảnh */
    object-fit: cover; /* Giữ tỷ lệ và cắt phần dư nếu cần */
}

</style>
<section id="cart_items">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Thanh toán</li>
				</ol>
			</div><!--/breadcrums-->
			<div class="register-req">
				<p>Vui lòng nhập thông tin giao hàng để tiến hành thanh toán</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Thông tin đơn hàng</p>
							<form id="orderForm" method="POST">
									@csrf
									<input type="text" name="shipping_name" class="shipping_name" placeholder="Tên người nhận" required>
									<input type="email" name="shipping_email" class="shipping_email" placeholder="Địa chỉ email" required>
									<input type="text" name="shipping_phone" class="shipping_phone" placeholder="Số điện thoại" required>
									<input type="text" name="shipping_address" class="shipping_address" placeholder="Địa chỉ nhận hàng *" required>
									<textarea name="shipping_note" class="shipping_note" placeholder="Ghi chú đơn hàng của bạn" rows="5"></textarea>
									
									@if(Session::get('fee'))
										<input type="hidden" name="fee_shipping" class="fee_shipping" value="{{Session::get('fee')}}">
									@else 
										<input type="hidden" name="fee_shipping" class="fee_shipping" value="10000">
									@endif

									@if(Session::get('coupon'))
										@foreach(Session::get('coupon') as $key => $cou)
											<input type="hidden" name="coupon_value" class="coupon_value" value="{{$cou['coupon_code']}}">
										@endforeach
									@else 
										<input type="hidden" name="coupon_value" class="coupon_value" value="no">
									@endif
									<div class="form-group">
										<label for="payment_select" style="margin-left: 50px;">Chọn phương thức thanh toán</label>
										<select class="form-control input-sm m-bot15 payment_select" name="payment_select" id="payment_select">
											<option value="0">Tiền mặt</option>
											<option value="1">Chuyển khoản</option>
										</select>
									</div>
									<input type="button" name="confirm-order" class="btn btn-primary sm-10 confirm-order" value="Xác nhận thông tin đơn hàng">
								</form>


								<form action="{{URL::to('/')}}" method="POST">
								@csrf
								<div class="form-group">
                                    <label for="exampleInputFile" style="margin-left: 50px;">Chọn thành phố</label>
                                    <select class="form-control input-sm m-bot15 choose city" name="nameCity" id="nameCity">
                                        <option value="0">Chọn tỉnh thành phố</option>
                                        @foreach($cityData as $key => $ci) 
                                            <option value="{{ $ci->matp }}">{{ $ci->nameCity }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile" style="margin-left: 50px;">Chọn quận huyện</label>
                                    <select class="form-control input-sm m-bot15 choose province" name="nameProvince" id="nameProvince">
                                        <option value="0">Chọn quận huyện</option>
                                        
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile" style="margin-left: 50px;">Chọn xã phường</label>
                                    <select class="form-control input-sm m-bot15 ward" name="nameWards" id="nameWards">
                                        <option value="0">Chọn xã phường</option>
										
                                    </select>
                                </div>
                               
                                <button type="button" class="btn btn-info feeship_calculate">Tính phí vận chuyển</button>
								</form>
					
						</div>
					</div>			
				</div>
			</div>
			<div class="table-responsive cart_info">
			<?php
				$totalcartPrice = 0;
			?>
			

			@if(session()->has('message'))
			<div class="alert alert-danger">
				{{ session()->get('message') }}
			</div>
			@elseif(session()->has('error'))
				{{ session()->get('error') }}
			@endif
			
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="description">Tên sản phẩm</td>
							<td class="price">Giá sản phẩm</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Thành tiền</td>
							<td></td>
						</tr>
					</thead>
					<form action="{{URL::to('/update-cart')}}" method="POST">
					<tbody>
					
					@if(Session::get('cart'))
                        @foreach(Session::get('cart') as $key => $cart)
						
						<tr>
						<tr>
									<td class="cart_product">
										<a href="">
											<img src="{{ isset($cart['product_image']) ? URL::to('public/upload/product/'.$cart['product_image']) : 'public/upload/product/default.png' }}"
												alt="" width="50" height="50">
										</a>
									</td>
									<td class="cart_description">
										<h4>
											<a href="{{ isset($cart['product_id']) ? URL::to('/chi-tiet-san-pham/'.$cart['product_id']) : '#' }}">
												{{ isset($cart['product_name']) ? $cart['product_name'] : 'Sản phẩm không xác định' }}
											</a>
										</h4>
									</td>
									<td class="cart_price">
										<p>
											{{ isset($cart['product_price']) ? number_format($cart['product_price'], 0, ',', '.') . 'đ' : 'Không xác định' }}
										</p>
									</td>

							<td class="cart_quantity">
								
								{{ csrf_field() }}
								<div class="cart_quantity_button">
								<input class="cart_quantity_input" type="number" min="1" name="quantity_change[{{ isset($cart['session_id']) ? $cart['session_id'] : '' }}]" value="{{ isset($cart['product_qty']) ? $cart['product_qty'] : 1 }}" size="2">
								</div>
								
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
								@php
									$totalPrice = isset($cart['product_price'], $cart['product_qty']) 
												? $cart['product_price'] * $cart['product_qty'] 
												: 0;
									echo number_format($totalPrice, 0, ',', '.').'đ';

									$totalcartPrice += $totalPrice;
									@endphp
									</p>
							</td>
							<td class="cart_delete">
							<a class="cart_quantity_delete" href="{{ isset($cart['session_id']) ? URL::to('/del-cart/'.$cart['session_id']) : '#' }}">

							</td>
                        
						</tr>
                        @endforeach
						
						<tr>
							<td colspan="5">
		
								<?php
								$customer_id = Session::get('customer_id');
								?>


								<div class="pull-right"><ul>
									<li>Tổng tiền sản phẩm: <span>{{number_format($totalcartPrice,0,',','.')}} đ</span></li>
											
									@if(Session::get('coupon'))
										@foreach(Session::get('coupon') as $key => $val)
											@if($val['coupon_condition'] == 1)
												<li>Mã giảm: {{ $val['coupon_number']}} % <a href="{{url('/unset-coupon')}}"><i class="fa fa-times"></i></a></li>
												
												@php
													$couponMonmey = ($totalcartPrice * $val['coupon_number']) / 100;
													echo '<li>Số tiền được giảm: '.number_format($couponMonmey,0,',','.').' đ</li>';
													$totalAfterCoupon = $totalcartPrice - $couponMonmey;
													
												@endphp
											@else
												<li>Mã giảm: {{ number_format($val['coupon_number'],0,',','.')}} đ <a href="{{url('/unset-coupon')}}"><i class="fa fa-times"></i></a></li>
												
												@php
													echo '<li>Số tiền được giảm: '.number_format($val['coupon_number'],0,',','.').' đ</li>';
													$totalAfterCoupon = $totalcartPrice - $val['coupon_number'];
													
												@endphp
											@endif
										@endforeach
									@endif
									@if(Session::get('fee'))
										<li>Phí vận chuyển: <span>{{number_format(Session::get('fee'),0,',','.')}}	
										<a href="{{url('/delete-fee-home')}}"><i class="fa fa-times"></i></a>
										</span></li>
									@endif

									<?php 
										$totalAfterAll = 0;
										if(Session::get('coupon')) {
											if(!Session::get('fee')) {
												$totalAfterAll = $totalAfterCoupon;
											} elseif(Session::get('fee')) {
												$totalAfterAll = $totalAfterCoupon + Session::get('fee');
											} 
										} else {
											if(Session::get('fee')) {
												$totalAfterAll = $totalcartPrice + Session::get('fee');
											} else {
												$totalAfterAll = $totalcartPrice;
											} 
										}
										echo '<li>Tổng tiền thanh toán: '.number_format($totalAfterAll,0,',','.').' đ</li>';
									?>
									
								</ul></div>
							</td>
						</tr>
					
						
					</tbody>
					</form>
					<tr>
						<td>
							<form action="{{URL::to('/check-coupon')}}" method="POST">
							@csrf
							<input type="text" name="coupon_code" value="@php 
							if(Session::get('coupon')) {
								foreach(Session::get('coupon') as $key =>$val) {
									echo $val['coupon_code'];
								}
							}
							@endphp" class="form-control" placeholder="Nhập mã giảm giá">
							@if(Session::get('coupon'))
							<a href="{{URL::to('/unset-coupon')}}" class="btn btn-danger" style="width: 100%;">Xóa mã giảm giá</a>
							@else
							<input type="submit" class="btn btn-warning" style="width: 100%;" value="Áp dụng mã giảm giá">
							@endif
							</form>
						</td>
					</tr>
					@else
						<tr><td colspan="5"><center><p>Không có sản phẩm nào</p></center></td></tr>
						@endif
				</table>
				
				
			</div>
			
	</section> <!--/#cart_items-->
@endsection