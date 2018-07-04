<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'item_id', 'quantity','purchase_price','sell_price' ,'details'
    ];
}
