@extends('layout')
@section("content")
<section id="form" style="display: flex; justify-content: center; align-items: center; height: 110vh; background: linear-gradient(to bottom, #6362a8, #a9a8df);">
    <div style="max-width: 400px; width: 100%; background: rgba(255, 255, 255, 0.2); padding: 30px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); backdrop-filter: blur(10px); text-align: center; font-family: 'Arial', sans-serif; color: white;">
        <!-- Form Đăng Nhập -->
        <div id="login-form" style="display: block;">
            <h2 style="font-size: 24px; font-weight: bold;">Đăng nhập</h2>
            <form action="{{URL::to('/login')}}" method="POST" style="margin-top: 20px;">
                {{ csrf_field() }}
                <span style="display: block; color: red; text-align: center; margin-bottom: 10px;">
                    <?php 
                        use Illuminate\Support\Facades\Session;
                        $message = Session::get('message');
                        if($message) {
                            echo $message;
                            Session::put('message', NULL);
                        }
                    ?>
                </span>
                <input type="email" name="email_account" placeholder="Địa chỉ email" style="width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid rgba(255, 255, 255, 1); border-radius: 8px; background: rgba(255, 255, 255, 1); color: black;">
                <input type="password" name="password_account" placeholder="Mật khẩu" style="width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid rgba(255, 255, 255, 1); border-radius: 8px; background: rgba(255, 255, 255, 1); color: black;">
                <div style="margin-bottom: 15px; text-align: left; ">
				<label style="display: flex; align-items: end; font-size: 14px; color: white;">
    <input type="checkbox" class="checkbox" style="margin-right: 5px; color: white;"> Ghi nhớ đăng nhập
</label>

                </div>
                <button type="submit" style="width: 100%; padding: 12px; margin-top: 10px; background-color: #4e4cb8; border: none; border-radius: 8px; color: white; font-size: 16px; cursor: pointer;">Đăng nhập</button>
            </form>
            <div class="text-center" style="margin-top: 20px;">
                <button class="btn btn-link" onclick="showRegister()" style="color: white; font-size: 14px; cursor: pointer; text-decoration: underline;">Bạn chưa có tài khoản? Đăng ký</button>
            </div>
        </div>

        <!-- Form Đăng Ký -->
        <div id="register-form" style="display: none;">
            <h2 style="font-size: 24px; font-weight: bold;">Đăng ký tài khoản</h2>
            <form action="{{URL::to('/add-customer')}}" method="POST" style="margin-top: 20px;">
                {{ csrf_field() }}
                <input type="text" name="customer_name" placeholder="Họ tên" style="width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid rgba(255, 255, 255, 1); border-radius: 8px; background: rgba(255, 255, 255, 1); color: black;" required>
                <input type="email" name="customer_email" placeholder="Địa chỉ email" style="width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid rgba(255, 255, 255, 1); border-radius: 8px; background: rgba(255, 255, 255, 1); color: black;" required>
                <input type="tel" name="customer_phone" placeholder="Số điện thoại" style="width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid rgba(255, 255, 255, 1); border-radius: 8px; background: rgba(255, 255, 255, 1); color: black;" required>
                <input type="password" name="customer_password" placeholder="Mật khẩu" style="width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid rgba(255, 255, 255, 1); border-radius: 8px; background: rgba(255, 255, 255, 1); color: black;" required>
                <div class="g-recaptcha" style="margin-top:10px; margin-bottom:15px;" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
                <button type="submit" style="width: 100%; padding: 12px; margin-top: 10px; background-color: #4e4cb8; border: none; border-radius: 8px; color: white; font-size: 16px; cursor: pointer;">Đăng ký</button>
            </form>
            <div class="text-center" style="margin-top: 20px;">
                <button class="btn btn-link" onclick="showLogin()" style="color: white; font-size: 14px; cursor: pointer; text-decoration: underline;">Đã có tài khoản? Đăng nhập</button>
            </div>
        </div>
    </div>
</section>

<script>
    function showLogin() {
        document.getElementById('login-form').style.display = 'block';
        document.getElementById('register-form').style.display = 'none';
    }

    function showRegister() {
        document.getElementById('login-form').style.display = 'none';
        document.getElementById('register-form').style.display = 'block';
    }
</script>
@endsection
