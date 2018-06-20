<?php

namespace App\Http\Resources\Items;

use App\Models\Brand;
use App\Models\Item;
use Illuminate\Http\Resources\Json\Resource;

class ItemCollectionResoruce extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'brand' => Brand::select('id','name')->where('id','=',$this->brand_id)->first(),
            'unit'=> $this->unit,
            'purchase_price'=> $this->purchase_price,
            'sell_price'=> $this->sell_price

        ];
    }
}
