<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'code', 'item_id', 'supplier_id','purchased_by', 'quantity','purchase_price','sell_price','discount','details'
    ];
}
