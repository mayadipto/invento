<?php

namespace App\Http\Resources\Purchases;

use App\Models\Item;
use App\Models\Supplier;
use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
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
            "id" => $this->id,
            "code" => $this->code,
            "item" => Item::find($this->item_id),
            "supplier" => Supplier::find($this->supplier_id),
            "purchased_by" => User::find($this->purchased_by),
            "quantity" => $this->quantity,
            "purchase_price" => $this->purchase_price,
            "sell_price" => $this->sell_price,
            "details" => $this->details,
            'created_at'=> $this->created_at->format('Y:m:d H:i:s'),
            'updated_at'=> $this->updated_at->format('Y:m:d H:i:s')
        ];
    }
}
