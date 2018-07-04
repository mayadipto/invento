<?php

namespace App\Http\Resources\SellsResource;

use App\Http\Resources\Items\ItemCollectionResoruce;
use App\Models\Brand;
use App\Models\Item;
use App\Models\ItemCategory;
use App\User;
use Illuminate\Http\Resources\Json\Resource;

class SellCollectionResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $item = Item::find($this->item_id);
        return [
            'id'=> $this->id,
            'item'=> new ItemCollectionResoruce($item),
            'quantity' => $this->quantity,
            'purchase_price'=> $this->purchase_price,
            'sell_price'=> $this->sell_price,
            'discount'=> $item->discount,
            'details'=> $this->details,
            'created_at' => $this->created_at->format('Y-m-d H:i:s')
        ];
    }
}
