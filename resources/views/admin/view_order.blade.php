<?php
use Illuminate\Support\Facades\Session;
?>

@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      THÔNG TIN NGƯỜI MUA
    </div>
    <div class="table-responsive">
    <?php
    $message = Session::get('message');
    if ($message) {
        echo '<span class="text-alert">'.$message.'</span>';
        Session::put('message', null);
    }
    ?>

      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên người mua</th>
            <th>Số điện thoại</th>
            <th>Email</th>
          </tr>
        </thead>
        <tbody>
          
          <tr>
          
            <td>{{$customer->customer_name}}</td>
            <td>{{$customer->customer_phone}}</td>
            <td>{{$customer->customer_email}}</td>
          </tr>
          
        </tbody>
      </table>
    </div>
    
  </div>
</div>
<br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
     THÔNG TIN VẬN CHUYỂN
    </div>
    <div class="table-responsive">
    <?php
    $message = Session::get('message');
    if ($message) {
        echo '<span class="text-alert">'.$message.'</span>';
        Session::put('message', null);
    }
    ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên người nhận hàng</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ giao hàng</th>
            <th>Email</th>
            <th>Ghi chú đơn hàng</th>
            <th>Hình thức thanh toán</th>
          </tr>
        </thead>
        <tbody>
          
          <tr>
            <td>{{$shipping->shipping_name}}</td>
            <td>{{$shipping->shipping_address}}</td>
            <td>{{$shipping->shipping_phone}}</td>
            <td>{{$shipping->shipping_email}}</td>
            <td>{{$shipping->shipping_note}}</td>
            <td>@if($shipping->shipping_method==0) Chuyển khoản
              @else 
              Tiền mặt
            @endif
            </td>
          </tr>
          
        </tbody>
      </table>
      
    </div>
     </div>
</div>
<br><br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LIỆT KÊ CHI TIẾT ĐƠN HÀNG
    </div>
    <div class="table-responsive">
    <?php
    $message = Session::get('message');
    if ($message) {
        echo '<span class="text-alert">'.$message.'</span>';
        Session::put('message', null);
    }
    ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width :20px;">
              <label class="i-checks m-b-none">
              <input type="checkbox"><i></i>
              </label>
            <th>Tên sản phẩm</th>
            <th>Số lượng kho còn</th>
            <th>Mã giảm giá</th>
            <th>Phí ship</th>
            <th>Số lượng</th>
            <th>Giá sản phẩm</th>
            <th>Tổng tiền</th>
          </tr>
        </thead>
        <tbody>

          @php 
          $i = 0;
          $total = 0;
          @endphp
          @foreach($order_detail as $key => $detail)
          
          
          @php  
          $i++;
          $subtotal = $detail->product_price * $detail->product_sales_quantity; // Sửa lỗi ở đây, sử dụng product_sales_quantity
          $total += $subtotal;
          @endphp
        <tr>
          <td><i>{{$i}}</i></td>
          <td>{{ $detail->product_name }}</td>
          <td>{{ $detail->product->product_quantity}}</td>
          <td>@if($detail->product_coupon!='no')
            {{ $detail->product_coupon }}
            @else
            Không mã giảm
            @endif
          </td>
          <td>{{ number_format( $detail->product_feeship, 0, ',', '.') }} VND</td>
          <td style="display: flex; align-items: center;">

          <input style="width: 30px;" type="number" min="1" {{$order_status==2 ? 'disabled' : ''}} class="order_qty_{{$detail->product_id}}" value="{{$detail->product_sales_quantity}}" name="product_sales_quantity">
          
          <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$detail->product_id}}" value="{{$detail->product->product_quantity}}">

          <input type="hidden" name="order_code" class="order_code" value="{{$detail->order_code}}">

          <input type="hidden" name="order_product_id" class="order_product_id" value="{{$detail->product_id}}">
          @if($order_status!=2) 

              <button class="btn-gradient update_quantity_order"  data-product_id="{{$detail->product_id}}" name="update_quantity_order">Cập nhật</button>

            @endif
          </td>
          <td>{{ number_format($detail->product_price, 0, ',', '.') }} VND</td>
          <td>{{ number_format($subtotal, 0, ',', '.') }} VND</td>
      </tr>
  @endforeach
  <tr>
            <td colspan="2">  
            @php 
                $total_coupon = 0;
              @endphp
              @if($coupon_condition==1)
                  @php
                  $total_after_coupon = ($total*$coupon_number)/100;
                  echo 'Tổng giảm :'.number_format($total_after_coupon,0,',','.').'</br>';
                  $total_coupon = $total + $detail->product_feeship - $total_after_coupon ;
                  @endphp
              @else 
                  @php
                  echo 'Tổng giảm :'.number_format($coupon_number,0,',','.').' VNĐ'.'</br>';
                  $total_coupon = $total + $detail->product_feeship - $coupon_number ;

                  @endphp
              @endif

              Phí ship : {{number_format($detail->product_feeship,0,',','.')}}  VNĐ</br> 
             Thanh toán: {{number_format($total_coupon,0,',','.')}}  VNĐ 

            </td>
          </tr>

          <tr>
            <td colspan="6">
            <!-- @foreach($order as $key => $or) -->
            @if($or->order_status==1)
                <form>
                   @csrf
                  <select class="form-control order_detail">
                    <option value="">----Chọn hình thức đơn hàng-----</option>
                    <option id="{{$or->order_id}}" selected value="1">Chưa xử lý</option>
                    <option id="{{$or->order_id}}" value="2">Đã xử lý-Đã giao hàng</option>
                    <option id="{{$or->order_id}}" value="3">Hủy đơn hàng-tạm giữ</option>
                  </select>
                </form>
                @elseif($or->order_status==2)
                <form>
                  @csrf
                  <select class="form-control order_detail">
                    <option value="">----Chọn hình thức đơn hàng-----</option>
                    <option id="{{$or->order_id}}" value="1">Chưa xử lý</option>
                    <option id="{{$or->order_id}}" selected value="2">Đã xử lý-Đã giao hàng</option>
                    <option id="{{$or->order_id}}" value="3">Hủy đơn hàng-tạm giữ</option>
                  </select>
                </form>

                @else
                <form>
                   @csrf
                  <select class="form-control order_detail">
                    <option value="">----Chọn hình thức đơn hàng-----</option>
                    <option id="{{$or->order_id}}" value="1">Chưa xử lý</option>
                    <option id="{{$or->order_id}}"  value="2">Đã xử lý-Đã giao hàng</option>
                    <option id="{{$or->order_id}}" selected value="3">Hủy đơn hàng-tạm giữ</option>
                  </select>
                </form>
                @endif
                @endforeach
            </td>
          </tr>

        </body>
      </table>
      <a href="{{ URL::to('/print-order/' . $detail->order_code)}}" class="btn-gradient">In đơn hàng</a>
      <style>
.btn-gradient {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    color: #fff;
    text-align: center;
    text-decoration: none;
    background: linear-gradient(45deg, #6362a8, #8b83f3);
    border: none;
    border-radius: 5px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.btn-gradient:hover {
    background: linear-gradient(45deg, #8b83f3, #6362a8);
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    transform: scale(1.05);
}
.update_quantity_order {
    display: inline-block;
    padding: 5px 10px;
    font-size: 13px;
    font-weight: bold;
    color: #fff;
    text-align: center;
    background: linear-gradient(45deg, #6362a8, #8b83f3);
    border: none;
    border-radius: 0px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    transition: all 0.3s ease;
}

.update_quantity_order:hover {
    background: linear-gradient(45deg, #8b83f3, #6362a8);
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    transform: scale(1.05);
}

      </style>
    </div>
    
  </div>
</div>
@endsection