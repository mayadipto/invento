<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'code', 'contact_no', 'address', 'details', 'user_id', 'image'];
}
