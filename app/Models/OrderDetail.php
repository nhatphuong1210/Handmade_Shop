<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public $timestamps = false;
    protected $fillable = [
    'order_code',
    'product_id',
    'product_name',
    'product_price',
    'product_sales_quanlity',
    'product_coupon',
    'product_feeship',
    ];
    protected $primaryKey = 'order_details_id';
    protected $table = 'tbl_order_details';

    public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
        

    }
}
