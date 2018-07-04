<?php

namespace App\Http\Resources\Purchases;

use App\Models\Brand;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\PurchaseInvoice;
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
        $supplier = Supplier::find($this->supplier_id);
        return [
            "id" => $this->id,
            "item" => [
                'name' => $item->name,
                'brand' => Brand::find($item->brand_id)->name,
                'category'=> ItemCategory::find($item->item_category_id)->name,
                'unit'=> $item->unit
            ],
            'details'=> $this->details,
            "quantity" => $this->quantity,
            "purchase_price" => $this->purchase_price,
            "sell_price" => $this->sell_price,
            "created_at" => $this->created_at->format('Y-m-d H:i:s')
        ];
    }
}
