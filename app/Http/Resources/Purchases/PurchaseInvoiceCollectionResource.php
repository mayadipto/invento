<?php

namespace App\Http\Resources\Purchases;

use App\Models\Supplier;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Resources\Json\Resource;

class PurchaseInvoiceCollectionResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = User::find($this->purchased_by);
        $supplier = Supplier::find($this->supplier_id);
        return [
            'id'=> $this->id,
            'code'=> $this->code,
            'total_purchase_price'=> $this->total_purchase_price,
            'created_at'=> $this->created_at->format('Y-m-d H:i:s'),
            'supplier' => [
                'id'=> $supplier->id,
                'name'=> $supplier->name,
                'contact_no'=> $supplier->contact_no
            ],
            'purchased_by'=> [
                'name'=> $user->name,
                'id'=> $user->id,
                'email'=> $user->email
            ]
        ];
    }
}
