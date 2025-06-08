<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function allMessages()
{
    $messages = Message::orderBy('created_at', 'desc')->get(); // Lấy tất cả tin nhắn
    return view('admin.all_messages', compact('messages'));   // Truyền dữ liệu sang view
}

    public function sendMail(Request $request)
    {
        $request->validate([
            'contact_name' => 'required|string|max:255',
            'contact_email' => 'required|email',
            'contact_subject' => 'required|string|max:255',
            'contact_message' => 'required|string|max:5000',
        ]);

        Message::create([
            'name' => $request->contact_name,
            'email' => $request->contact_email,
            'subject' => $request->contact_subject,
            'message' => $request->contact_message,
        ]);

        return redirect()->back()->with('message', 'Lời nhắn đã được gửi và lưu thành công!');
    }
}
