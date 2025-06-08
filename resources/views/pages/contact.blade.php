<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ với HandmadeShop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background: linear-gradient(135deg, #6362a8, #8a63a8);
            color: #fff;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            gap: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .title {
            font-size: 26px;
            color: #4e4da3;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Bên trái: Form liên hệ */
        .contact-form {
            flex: 1;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 30px 20px;
        }

        .contact-form form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s;
        }

        .contact-form input:focus,
        .contact-form textarea:focus {
            border-color: #6362a8;
        }

        .contact-form input[type="submit"] {
            background: linear-gradient(135deg, #6362a8, #4e4da3);
            color: #fff;
            border: none;
            font-size: 18px;
            cursor: pointer;
            border-radius: 8px;
            padding: 12px;
            transition: background-color 0.3s ease-in-out;
        }

        .contact-form input[type="submit"]:hover {
            background: linear-gradient(135deg, #4e4da3, #6362a8);
        }

        /* Bên phải: Thông tin cửa hàng */
        .contact-info {
            flex: 1;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 30px 20px;
        }

        .contact-info address p {
            font-size: 16px;
            margin: 8px 0;
            line-height: 1.6;
            color: #333;
        }

        .contact-info .social-networks ul {
            display: flex;
            justify-content: center;
            gap: 15px;
            list-style: none;
            margin: 20px 0 0;
            padding: 0;
        }

        .contact-info .social-networks ul li a {
            font-size: 28px;
            color: #6362a8;
            text-decoration: none;
            transition: transform 0.3s, color 0.3s;
        }

        .contact-info .social-networks ul li a:hover {
            color: #4e4da3;
            transform: scale(1.2);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .contact-form,
            .contact-info {
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Form liên hệ -->
        <div class="contact-form">
            <h2 class="title">Liên hệ với HandmadeShop</h2>
            <form action="{{ url('send-mail') }}" method="POST">
    @csrf
    <input type="text" name="contact_name" placeholder="Họ và tên" required>
    <input type="email" name="contact_email" placeholder="Email" required>
    <input type="text" name="contact_subject" placeholder="Tiêu đề" required>
    <textarea name="contact_message" rows="5" placeholder="Nội dung" required></textarea>
    <input type="submit" value="Gửi lời nhắn">
</form>
@if(session('message'))
    <p style="color: green; text-align: center;">{{ session('message') }}</p>
@endif

        </div>

        <!-- Thông tin cửa hàng -->
        <div class="contact-info">
            <h2 class="title">Thông tin cửa hàng</h2>
            <address>
                <p><strong>Handmade Store</strong></p>
                <p>470 Đ. Trần Đại Nghĩa, Hoà Hải</p>
                <p> Ngũ Hành Sơn, Đà Nẵng, Việt Nam</p>
                <p>Điện thoại: 0123 456 789</p>
                <p>Email: HandmadeShop@gmail.com</p>
            </address>
            <div class="social-networks">
                <h2 class="title">Kết nối với chúng tôi</h2>
                <ul>
                    <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
