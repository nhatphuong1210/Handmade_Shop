<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use GuzzleHttp\Client;

class ReCaptcha implements Rule
{
    public function passes($attribute, $value)
    {
        $client = new Client();
        $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => env('CAPTCHA_SECRET'), // Secret key từ file .env
                'response' => $value,              // Token từ phía client
                'remoteip' => request()->ip(),     // Địa chỉ IP của client
            ],
        ]);

        $body = json_decode((string) $response->getBody(), true);
        return isset($body['success']) && $body['success'] === true;
    }

    public function message()
    {
        return 'Xác thực reCAPTCHA thất bại. Vui lòng thử lại.';
    }
}
