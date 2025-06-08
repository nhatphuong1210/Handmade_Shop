<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $customerEmail = $request->input('email');

        // Gửi email xác nhận
        Mail::to($customerEmail)->send(new ConfirmRegistration($customerEmail));

        return back()->with('success', 'Đăng ký thành công! Vui lòng kiểm tra email của bạn.');
    }
}
