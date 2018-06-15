<?php

namespace App\Http\Resources\Purchases;

use App\Models\Brand;
use App\Models\Item;
use App\Models\Supplier;
use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseCollectionResource extends JsonResource
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
            "id" => $this->id,
            "code" => $this->code,
            "item" => [
                'name' => $item->name,
                'brand' => Brand::find($item->brand_id)->name
            ],
            "supplier" => [
                'name' => Supplier::find($this->supplier_id)->name
            ],
            "purchased_by" => [
                'name'=> User::find($this->purchased_by)->name
            ],
            "quantity" => $this->quantity,
            "purchase_price" => $this->purchase_price,
            "sell_price" => $this->sell_price
        ];
    }
}
