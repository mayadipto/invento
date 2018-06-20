<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function brand (){
        return $this->belongsTo('App\Brand');
    }
}
