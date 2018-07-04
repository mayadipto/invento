<?php

namespace App\Http\Resources\Expense;

use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use App\User;
use Illuminate\Http\Resources\Json\Resource;

class ExpenseInvoiceCollectionResource extends Resource
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
            'expense_by'=> User::select('name','id')->where('id','=', $this->expense_by)->first(),
            'total_amount'=> $this->total_amount,
            'urls'=> [],
            'created_at'=> $this->created_at->format('Y-m-d H:i:s')
        ];
    }
}
