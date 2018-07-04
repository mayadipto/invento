<?php

namespace App\Http\Resources\Purchases;

use App\Http\Resources\Items\ItemCollectionResoruce;
use App\Models\Item;
use App\Models\Purchase;
use App\Models\Supplier;
use App\User;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\DB;

class PurchaseInvoiceResource extends Resource
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
            'id'=> $this->id,
            'code'=> $this->code,
            'total_purchase_price'=> $this->total_purchase_price,
            'items' => PurchaseCollectionResource::collection(
                Purchase::where('purchase_invoice_id','=',$this->id)->get()),
            'supplier'=> Supplier::find($this->supplier_id),
            'purchased_by'=> User::find($this->purchased_by),
            'created_at'=> $this->created_at->format('Y-m-d H:i:s'),
            'urls' => DB::table('purchase_files')
                ->select('id','url')
                ->where('purchase_invoice_id','=', $this->id)->get()
        ];
    }
}
