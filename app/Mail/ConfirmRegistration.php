<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmRegistration extends Mailable
{
    use Queueable, SerializesModels;

    public $customerEmail;

    /**
     * Create a new message instance.
     */
    public function __construct($customerEmail)
    {
        $this->customerEmail = $customerEmail;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Xác nhận đăng ký nhận tin từ HandmadeShop')
                    ->view('emails.confirm_registration')
                    ->with([
                        'customerEmail' => $this->customerEmail,
                    ]);
    }
}
