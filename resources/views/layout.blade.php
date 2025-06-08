<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $meta_desc }}">
	<meta name="robots" content="INDEX,FOLLOW"/>
	<meta name="keywords" content="{{ $meta_keywords }}">
	<link rel = "canonical" href = "{{ $meta_canonical }}" />
    <title>{{ $meta_title }}</title>
	<meta property="og:image" content="{{$image_og}}" />
	<meta property="og:site_name" content="shopbanhanglaravel.com" /> <!-- Thay doi domain -->
	<meta property="og:description" content="{{$meta_desc}}" />
	<meta property="og:title" content="{{$meta_title}}" />
	<meta property="og:url" content="{{$meta_canonical}}" />
	<meta property="og:type" content="website" />

    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{asset('public/frontend/img/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png')}}">
</head><!--/head-->

<body>
	<?php
	use Illuminate\Support\Facades\Session;
	?>
	<header id="header"><!--header-->
    <div class="header_top" style="background-color: #3a396c; color: #fff; padding: 2px 0;">
    <div class="container">
        <div class="row">
            <!-- Left: Contact Info -->
            <div class="col-xs-12 col-sm-6">
                <div class="contactinfo">
                    <ul class="list-inline" style="margin: 0; padding: 0;">
                        <li style="display: inline-block; margin-right: 20px; line-height: 2.5; font-size: 15px;"><i class="fa fa-phone" style="margin-right: 5px; font-size: 16px;"></i><span>0123 456 789</span></li>
                        <li style="display: inline-block; line-height: 1.5; font-size: 14px;"><i class="fa fa-envelope" style="margin-right: 5px; font-size: 16px;"></i><span>HandmadeShop@gmail.com</span></li>
                    </ul>
                </div>
            </div>

            <!-- Right: Social Icons -->
            <div class="col-xs-12 col-sm-6 text-right">
                <div class="social-icons">
                    <ul class="list-inline" style="margin: 0; padding: 0;">
                        <li style="display: inline-block; margin-right: 10px;">
                            <a href="#" class="social-icon" style="color: #fff; font-size: 16px;">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li style="display: inline-block; margin-right: 10px;">
                            <a href="#" class="social-icon" style="color: #fff; font-size: 16px;">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li style="display: inline-block; margin-right: 10px;">
                            <a href="#" class="social-icon" style="color: #fff; font-size: 16px;">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </li>
                        <li style="display: inline-block; margin-right: 10px;">
                            <a href="#" class="social-icon" style="color: #fff; font-size: 16px;">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </li>
                        <li style="display: inline-block;">
                            <a href="#" class="social-icon" style="color: #fff; font-size: 16px;">
                                <i class="fa fa-youtube"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="header-middle">
        <div class="container">
            <div class="row" style="display: flex; align-items: center; justify-content: space-between;">
                <!-- Logo -->
                <div class="logo">
                    <a href="{{URL::to('trang-chu')}}">
                        <img src="{{URL::to('public/frontend/img/home/logo.png')}}" alt="Logo">
                    </a>
                </div>
                
                <!-- Menu và Thanh tìm kiếm -->
                <div style="display: flex; align-items: center;">
                    <!-- Menu -->
                    <ul class="nav navbar-nav" style="display: flex; align-items: center; margin-right: 20px;">
					<li><a href="{{URL::to('/login-checkout')}}" style="color: #807ab5;"><i class="fa fa-user" style="color: #807ab5;"></i> Tài khoản
							<?php
							$customer_name = Session::get('customer_name');
							if ($customer_name) {
								echo " (" . $customer_name . ")";
							}
							?>
						</a></li>
						<li><a href="{{URL::to('/checkout')}}" style="color: #807ab5;"><i class="fa fa-credit-card" style="color: #807ab5;"></i> Thanh toán</a></li>
						<li><a href="{{URL::to('/gio-hang')}}" style="color: #807ab5;"><i class="fa fa-shopping-cart" style="color: #807ab5;"></i> Giỏ hàng</a></li>
						<?php

									$customer_id = Session::get('customer_id');
									if ($customer_id != NULL) { // Kiểm tra nếu customer_id bằng NULL
									?>
										<li><a href="{{URL::to('/logout-checkout')}}" style="color: #807ab5;"><i class="fa fa-arrow-right" style="color: #807ab5;"></i> Đăng xuất</a></li>
									<?php
									} else {
									?>
										<li><a href="{{URL::to('/logout-checkout')}}" style="color: #807ab5;"><i class="fa fa-user" style="color: #807ab5;"></i> Đăng nhập</a></li>
									<?php
									}
									?>
                        <li><a href="{{URL::to('/contact')}}" style="color: #807ab5;"><i class="fa fa-envelope" style="color: #807ab5;"></i> Liên hệ</a></li>
					</ul>
                    
                    <!-- Thanh tìm kiếm -->
                    <form action="{{URL::to('/tim-kiem')}}" method="POST" 
                          style="display: flex; align-items: center; 
                                 border: 1px solid #ddd; border-radius: 50px; 
                                 overflow: hidden; background-color: #fff; 
                                 padding: 3px; width: 240px;">
                        {{ csrf_field() }}
                        
                        <!-- Input tìm kiếm -->
                        <input type="text" placeholder="Tìm kiếm sản phẩm" name="keywordsubmit" 
                               style="border: none; padding: 8px 10px; flex: 1; 
                                      outline: none; font-size: 12px;">
                        
                        <!-- Nút gửi -->
                        <input type="submit" value="Tìm kiếm" 
                               style="background-color: #6362a8; color: white; border: none; 
                                      padding: 6px 12px; font-size: 12px; border-radius: 45px; 
                                      cursor: pointer; transition: background-color 0.3s;">
                    </form>
                </div>
            </div>
        </div>
    </div>
</header><!--/header-->

<!-- CSS và JavaScript tích hợp trực tiếp -->
<style>
    /* CSS cho header */
    #header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background-color: #fff;
        z-index: 999;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Bóng đổ nhẹ cho header */
    }
	#slider {
    margin-top: 140px; /* Tạo khoảng cách đủ lớn để tránh header che chắn */
}
    /* Đảm bảo nội dung không bị che khuất khi cuộn */
    main {
        padding-top: 120px; /* Khoảng cách đủ để nội dung không bị header che mất */
    }
</style>

<script>
    // JavaScript xử lý để header cố định khi cuộn
    window.addEventListener('scroll', function() {
        let header = document.getElementById('header');
        if (window.scrollY > 0) {
            // Khi cuộn xuống, giữ header cố định
            header.style.position = 'fixed';
        } else {
            // Khi không cuộn, giữ header ở vị trí ban đầu
            header.style.position = 'fixed';
        }
    });
</script>

	
	<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>
                    
                    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="2000">
    <div class="carousel-inner">
        <!-- Item 1: Video -->
        <div class="item active">
            <div class="col-sm-12">
                <video controls autoplay muted loop class="img-responsive">
                    <source src="http://localhost/shopbanhang/public/frontend/video/thocamhandmade.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>

        <!-- Item 2: Image 1 -->
        <div class="item">
            <div class="col-sm-12">
                <img src="http://localhost/shopbanhang/public/frontend/img/home/handmade02.png" class="img-responsive" alt="">
            </div>
        </div>

        <!-- Item 3: Image 2 -->
        <div class="item">
            <div class="col-sm-12">
                <img src="http://localhost/shopbanhang/public/frontend/img/home/handmade02.png" class="img-responsive" alt="">
            </div>
        </div>
    </div>
</div>

                    
                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section> <!--slider-->

	
<style>
        /* CSS cho sidebar */
        .animated-gradient-button {
    background: linear-gradient(45deg, #807ab5, #6362a8);
    color: white;
    font-weight: bold;
    text-transform: uppercase;
    border: none;
    border-radius: 25px;
    padding: 10px 20px;
    transition: all 0.3s ease;
    cursor: pointer;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
}

.animated-gradient-button:hover {
    transform: scale(1.1);
    background: linear-gradient(45deg, #6362a8, #807ab5);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
}

.animated-cancel-button {
    background: linear-gradient(45deg, #807ab5, #6362a8);
    color: white;
    font-weight: bold;
    text-transform: uppercase;
    border: none;
    border-radius: 25px;
    padding: 10px 20px;
    transition: all 0.3s ease;
    cursor: pointer;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
}

.animated-cancel-button:hover {
    transform: scale(1.1);
    background: linear-gradient(45deg, #6362a8, #807ab5);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
}
        .left-sidebar {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
            border-bottom: 2px solid #6362a8;
            padding-bottom: 10px;
        }

        .category-products .panel-default {
            border: none;
            margin-bottom: 10px;
        }

        .panel-heading {
            background-color: #fff;
            padding: 10px 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .panel-title a {
            color: #333;
            font-size: 16px;
            text-decoration: none;
            display: block;
            padding: 10px 0;
        }

        .panel-title a:hover {
            color: #6362a8;
        }

        .brands_products .brands-name ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .brands-products .brands-name li {
            padding: 8px 15px;
            border-bottom: 1px solid #ddd;
        }

        .brands-products .brands-name li a {
            color: #333;
            font-size: 16px;
            text-decoration: none;
        }

        .brands-products .brands-name li a:hover {
            color: #6362a8;
        }

        .shipping img {
            max-width: 100%;
            height: auto;
            margin-top: 15px;
        }

        /* CSS cho main content */
        .padding-right {
            padding-right: 30px;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .col-sm-3 {
                padding-left: 0;
            }

            .col-sm-9 {
                padding-right: 0;
            }

            .left-sidebar {
                padding: 20px;
            }

            .section-title {
                font-size: 18px;
            }

            .panel-title a {
                font-size: 14px;
            }

            .brands-products .brands-name li {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <section>
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2 class="section-title">Danh mục sản phẩm</h2>
                        <div class="panel-group category-products" id="accordion">
                            @foreach($category_product as $key => $cate)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a href="{{URL::to('danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a>
                                        </h4>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="brands_products">
                            <h2 class="section-title">Thương hiệu sản phẩm</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    @foreach($branch_product as $key => $branch)
                                        <li>
                                            <a href="{{URL::to('thuong-hieu-san-pham/'.$branch->branch_id)}}"> 
                                                <span class="pull-right">(50)</span>{{$branch->branch_name}}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="shipping text-center">
                            <img src="{{URL::to('public/frontend/img/home/shipping.png')}}" alt="Shipping" />
                        </div>
                    </div>
                </div>

                <!-- Main content -->
                <div class="col-sm-9 padding-right">
                    @yield('content')
                </div>
            </div>
        </div>
    </section>



	<footer id="footer" style="background-color: #222; color: #fff; padding: 20px 0;">
    <div class="container">
        <div class="row">
            <!-- Giới thiệu công ty -->
            <div class="col-md-4">
                <h3 style="color: #6362a8;">Handmade-Shop</h3>
                <p style="font-size: 14px; line-height: 1.6;">
                    Chuyên cung cấp các sản phẩm thủ công mỹ nghệ độc đáo, chất lượng cao, làm từ tình yêu và sự sáng tạo.
                </p>
                <p style="font-size: 14px;">470 Đ. Trần Đại Nghĩa, Hoà Hải, Ngũ Hành Sơn, Đà Nẵng 550000</p>
            </div>

            <!-- Liên kết nhanh -->
            <div class="col-md-2">
                <h4 style="margin-bottom: 20px; color: #6362a8;">Liên kết nhanh</h4>
                <ul style="list-style: none; padding: 0; font-size: 14px; line-height: 2;">
                    <li><a href="{{URL::to('/contact')}}" style="color: #bbb; text-decoration: none;">Hỗ trợ trực tuyến</a></li>
                    <li><a href="{{URL::to('/contact')}}" style="color: #bbb; text-decoration: none;">Liên hệ</a></li>
                    <li><a href="{{URL::to('/contact')}}" style="color: #bbb; text-decoration: none;">Theo dõi đơn hàng</a></li>
                    <li><a href="{{URL::to('/contact')}}" style="color: #bbb; text-decoration: none;">Đổi trả hàng</a></li>
                    <li><a href="{{URL::to('/contact')}}" style="color: #bbb; text-decoration: none;">Câu hỏi thường gặp</a></li>
                </ul>
            </div>

            <!-- Sản phẩm -->
            <div class="col-md-2">
                <h4 style="margin-bottom: 20px; color: #6362a8;">Sản phẩm</h4>
                <ul style="list-style: none; padding: 0; font-size: 14px; line-height: 2;">
                    <li><a href="http://localhost/shopbanhang/danh-muc-san-pham/3" style="color: #bbb; text-decoration: none;">Trang trí</a></li>
                    <li><a href="http://localhost/shopbanhang/danh-muc-san-pham/5" style="color: #bbb; text-decoration: none;">Đồ gỗ thủ công</a></li>
                    <li><a href="http://localhost/shopbanhang/danh-muc-san-pham/6" style="color: #bbb; text-decoration: none;">Quà tặng</a></li>
                    <li><a href="http://localhost/shopbanhang/danh-muc-san-pham/2" style="color: #bbb; text-decoration: none;">Đồ gốm thủ công</a></li>
                    <li><a href="http://localhost/shopbanhang/danh-muc-san-pham/1" style="color: #bbb; text-decoration: none;">Trang sức handmade</a></li>
                </ul>
            </div>

            <!-- Đăng ký nhận tin -->
            <div class="col-md-4">
    <h4 style="margin-bottom: 20px; color: #6362a8;">Đăng ký nhận tin</h4>
    <!-- Form đăng ký -->
    <form action="{{ route('subscribe') }}" method="POST" style="display: flex; flex-direction: column;">
        @csrf
        <!-- Trường nhập email -->
        <input 
            type="email" 
            name="email" 
            placeholder="Nhập email của bạn" 
            style="padding: 10px; margin-bottom: 10px; border: none; border-radius: 5px; outline: none;" 
            required>
        
        <!-- Nút đăng ký -->
        <button 
            type="submit" 
            style="background-color: #6362a8; color: white; border: none; padding: 10px; border-radius: 5px; cursor: pointer;">
            Đăng ký
        </button>
    </form>

    <!-- Thông báo thành công -->
    @if(session('success'))
        <p style="font-size: 12px; margin-top: 10px; color: green;">
            {{ session('success') }}
        </p>
    @endif

    <!-- Thông báo lỗi -->
    @if($errors->any())
        <p style="font-size: 12px; margin-top: 10px; color: red;">
            {{ $errors->first() }}
        </p>
    @endif

    <!-- Đoạn mô tả -->
    <p style="font-size: 12px; margin-top: 10px; color: #bbb;">
        Nhận thông tin mới nhất về sản phẩm và ưu đãi từ cửa hàng chúng tôi!
    </p>
</div>
        </div>

        <!-- Dòng bản quyền -->
        <div class="footer-bottom" style="margin-top: 20px; border-top: 1px solid #444; padding-top: 10px; text-align: center;">
            <p style="font-size: 12px; color: #888; margin: 5px 0;">© 2024 Handmade-Shop. Mọi quyền được bảo lưu.</p>
            <p style="font-size: 12px; color: #888; margin: 5px 0;">
                Thiết kế bởi <a href="#" style="color: #6362a8; text-decoration: none;">Nhóm HandmadeShop</a>
            </p>
        </div>
    </div>
</footer>
<script>
		$(document).ready(function() {
			$('.add-to-cart').click(function() {
				var id = $(this).data('id_product');
				var cart_product_id = $('.product_id_'+id).val();
				var cart_product_name = $('.product_name_'+id).val();
				var cart_product_image = $('.product_image_'+id).val();
				var cart_product_price = $('.product_price_'+id).val();
				var cart_product_qty = $('.product_qty_'+id).val();
				var cart_product_token = $('input[name="_token"]').val();
				$.ajax({
					url: "{{url('/add-cart-ajax')}}",
					method: 'POST',
					data: {cart_product_id:cart_product_id, cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,
						cart_product_qty:cart_product_qty,_token:cart_product_token},
					success:function(data) {
						swal({
							title: "Sản phẩm đã được thêm vào giỏ hàng",
							text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
							icon: "success",
							showCancelButton: true,
							cancelButtonText: "Xem tiếp",

							confirmButtonClass: "btn-success",
							confirmButtonText: "Đi đến giỏ hàng",
							closeOnConfirm: false,
							}, function() {
								window.location.href = "{{url('/gio-hang')}}";
							}

							);

					},
					error: function (data, textStatus, errorThrown) {
						console.log(data);
					},
				})
			});
		})
	</script>
<script src="{{asset('public/frontend/js/jquery.js')}}"></script>
<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('public/frontend/js/price-range.js')}}"></script>
<script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('public/frontend/js/main.js')}}"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v11.0&appId=1011902732305839&autoLogAppEvents=1" nonce="D3BpO0xr"></script>

<script>
    $(document).ready(function () {
        // Thêm sản phẩm vào giỏ hàng
        $('.add-to-cart').click(function () {
            var id = $(this).data('id_product');
            var cart_product_id = $('.product_id_' + id).val();
            var cart_product_name = $('.product_name_' + id).val();
            var cart_product_image = $('.product_image_' + id).val();
            var cart_product_price = $('.product_price_' + id).val();
            var cart_product_qty = $('.product_qty_' + id).val();
            var cart_product_token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{url('/add-cart-ajax')}}",
                method: 'POST',
                data: {
                    cart_product_id: cart_product_id,
                    cart_product_name: cart_product_name,
                    cart_product_image: cart_product_image,
                    cart_product_price: cart_product_price,
                    cart_product_qty: cart_product_qty,
                    _token: cart_product_token
                },
                success: function (data) {
                    Swal.fire({
                    title: '<span style="background: linear-gradient(45deg, #807ab5, #6362a8); -webkit-background-clip: text; color: transparent;">Thêm vào giỏ hàng thành công!</span>',
                    text: "Bạn có thể tiếp tục mua sắm hoặc tới giỏ hàng để thanh toán.",
                    icon: 'success',
                    showCancelButton: true,
                    cancelButtonText: 'Xem tiếp',
                    confirmButtonText: 'Đi đến giỏ hàng',
                    confirmButtonColor: '#807ab5',
                    cancelButtonColor: '#6362a8',
                    customClass: {
                        confirmButton: 'animated-gradient-button',
                        cancelButton: 'animated-cancel-button',
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{url('/gio-hang')}}";
                    }
                });

                },
                error: function (error) {
                    Swal.fire({
                        title: 'Lỗi!',
                        text: 'Không thể thêm sản phẩm vào giỏ hàng. Vui lòng thử lại.',
                        icon: 'error',
                    });
                }
            });
        });

        // Xác nhận đặt hàng
        $('.confirm-order').click(function () {
            var shipping_name = $('.shipping_name').val();
            var shipping_email = $('.shipping_email').val();
            var shipping_phone = $('.shipping_phone').val();
            var shipping_address = $('.shipping_address').val();
            var shipping_note = $('.shipping_note').val();
            var shipping_method = $('.payment_select').val();
            var fee_shipping = $('.fee_shipping').val();
            var coupon_value = $('.coupon_value').val();
            var _token = $('input[name="_token"]').val();

            Swal.fire({
            title: '<span style="background: linear-gradient(45deg, #807ab5, #6362a8); -webkit-background-clip: text; color: transparent;">Xác nhận đặt hàng?</span>',
            text: "Bạn sẽ không thể hủy đơn hàng sau khi xác nhận.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Đồng ý',
            cancelButtonText: 'Hủy bỏ',
            confirmButtonColor: '#807ab5',
            cancelButtonColor: '#6362a8',
            customClass: {
                confirmButton: 'animated-gradient-button',
                cancelButton: 'animated-cancel-button'
            }
        }).then((result) => {
            if (result.isConfirmed) {
       
                    $.ajax({
                        url: '{{ url("/confirm-order") }}',
                        method: 'POST',
                        data: {
                            shipping_name: shipping_name,
                            shipping_email: shipping_email,
                            shipping_phone: shipping_phone,
                            shipping_address: shipping_address,
                            shipping_note: shipping_note,
                            fee_shipping: fee_shipping,
                            coupon_value: coupon_value,
                            shipping_method: shipping_method,
                            _token: _token
                        },
                        beforeSend: function () {
                            Swal.fire({
                                title: 'Đang xử lý...',
                                text: 'Vui lòng chờ trong giây lát.',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                        },
                        success: function () {
                            Swal.fire({
                                title: 'Thành công!',
                                text: 'Đơn hàng của bạn đã được xác nhận.',
                                icon: 'success',
                                timer: 3000,
                                showConfirmButton: false,
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function () {
                        Swal.fire({
                            title: '<span style="background: linear-gradient(45deg, #3a396c, #6a85b6); -webkit-background-clip: text; color: transparent;">Lỗi!</span>',
                            text: 'Có lỗi xảy ra, vui lòng thử lại sau.',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'animated-gradient-button' // Thêm hiệu ứng gradient cho nút OK
                            }
                        });
                    }

                    });
                }
            });
        });

        // Tính phí vận chuyển
        $('.feeship_calculate').click(function () {
            var cityId = $('.city').val();
            var provinceId = $('.province').val();
            var wardId = $('.ward').val();
            var _token = $('input[name="_token"]').val();

            if (cityId == 0 || provinceId == 0 || wardId == 0) {
                Swal.fire({
                    title: 'Thông báo!',
                    text: 'Vui lòng chọn địa chỉ giao hàng.',
                    icon: 'info',
                });
            } else {
                $.ajax({
                    url: '{{url::to("/calculate-fee")}}',
                    method: 'POST',
                    data: {
                        cityId: cityId,
                        provinceId: provinceId,
                        wardId: wardId,
                        _token: _token
                    },
                    success: function () {
                        Swal.fire({
                            title: 'Thành công!',
                            text: 'Phí vận chuyển đã được cập nhật.',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false,
                        }).then(() => {
                            location.reload();
                        });
                    }
                });
            }
        });

        // Tải danh sách quận/huyện
        $('.choose').on('change', function () {
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';

            if (action == 'nameCity') {
                result = "nameProvince";
            } else {
                result = "nameWards";
            }

            $.ajax({
                url: '{{url::to("/get-delivery-home")}}',
                method: 'POST',
                data: {
                    action: action,
                    ma_id: ma_id,
                    _token: _token
                },
                success: function (data) {
                    $('#' + result).html(data);
                }
            });
        });
    });
</script>

</body>
</html>