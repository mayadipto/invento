<?php

namespace App\Http\Resources\SellsResource;

use App\Models\Customer;
use App\Models\Sell;
use App\User;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\DB;

class SellInvoiceResource extends Resource
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
            'sell_by'=> User::find($this->sell_by),
            'customer'=> Customer::find($this->customer_id),
            'total_purchase_price'=> $this->total_purchase_price,
            'sell_items' => SellCollectionResource::
                collection(Sell::where('sell_invoice_id','=', $this->id)->get()),
            'total_sell_price'=> $this->total_sell_price,
            'vat'=> $this->vat,
            'vat_amount'=> $this->vat_amount,
            'files' => DB::table('sells_files')
                ->select('id','url')
                ->where('sell_invoice_id', '=', $this->id)->get(),
            'created_at'=> $this->created_at->format('Y-m-d H:i:s')
        ];
    }
}
