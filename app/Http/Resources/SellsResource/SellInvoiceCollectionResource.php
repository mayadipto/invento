<?php

namespace App\Http\Resources\SellsResource;

use App\Models\Customer;
use App\User;
use Illuminate\Http\Resources\Json\Resource;

class SellInvoiceCollectionResource extends Resource
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
            'code'=> $this->code,
            'sell_by'=> [
                'name'=> User::find($this->sell_by)->name
            ],
            'customer'=> [
                'name'=> Customer::find($this->customer_id)->name
            ],
            'total_purchase_price'=> $this->total_purchase_price,
            'total_sell_price'=> $this->total_sell_price,
            'vat'=> $this->vat,
            'vat_amount'=> $this->vat_amount,
            'created_at'=> $this->created_at->format('Y-m-d H:i:s')
        ];
    }
}
