<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $timetams = false;
    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_password',
        'customer_phone',
    ];
    protected $primaryKey = 'customer_id';
    protected $table = 'tbl_customers';
}
