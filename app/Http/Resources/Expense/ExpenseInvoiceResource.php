<?php

namespace App\Http\Resources\Expense;

use App\Http\Resources\ExpenseResource;
use App\Models\Employee;
use App\Models\Expense;
use App\User;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\DB;

class ExpenseInvoiceResource extends Resource
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
            'expense_by'=> Employee::where('id','=', $this->expense_by)->first(),
            'expense_items'=> ExpenseResource::collection(Expense::where('expense_invoice_id', '=', $this->id)->get()),
            'total_amount'=> $this->total_amount,
            'urls'=> DB::table('expense_files')->where('expense_invoice_id','=', $this->id)->get(),
            'created_at'=> $this->created_at->format('Y-m-d H:i:s')
        ];
    }
}
