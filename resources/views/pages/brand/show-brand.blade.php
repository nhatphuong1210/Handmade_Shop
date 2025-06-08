@extends('layout')
@section("content")
<div class="features_items"><!--features_items-->
@foreach($brand_name as $key => $brandName)
<h2 class="title text-center">{{$brandName->branch_name}}</h2>
@endforeach
@foreach($brand_by_id as $key => $pro_by_brand)
<div class="col-sm-4">
   
<div class="product-image-wrapper">
        <div class="single-products">
                <form action="GET">
                    <div class="productinfo text-center">
                        {{ csrf_field() }}
                        <input type="hidden" class="product_id_{{$pro->product_id}}" value="{{$pro->product_id}}">
                        <input type="hidden" class="product_name_{{$pro->product_id}}" value="{{$pro->product_name}}">
                        <input type="hidden" class="product_image_{{$pro->product_id}}" value="{{$pro->product_image}}">
                        <input type="hidden" class="product_price_{{$pro->product_id}}" value="{{$pro->product_price}}">
                        <input type="hidden" class="product_qty_{{$pro->product_id}}" value="1">

                        <a href="{{URL::to('chi-tiet-san-pham/'.$pro->product_id)}}">
                            <img src="{{URL::to('public/upload/product/'.$pro->product_image)}}" alt="" />
                            <h2>{{number_format($pro->product_price)." VND"}}</h2>
                            <p>{{$pro->product_name}}</p>
                        </a>
                        <button  type="button" class="btn btn-default add-to-cart" data-id_product="{{$pro->product_id}}"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
                    </div>

            </form>
        </div>
    </div>
</div>

@endforeach
</div><!--features_items-->

@endsection