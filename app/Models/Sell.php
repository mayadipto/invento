<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    protected $fillable = [
         'item_id', 'customer_id','purchased_by', 'quantity','sell_price','details','discount'
    ];
}
