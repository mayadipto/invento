<?php

namespace App\Http\Resources;

use App\Models\ExpenseItem;
use App\User;
use Illuminate\Http\Resources\Json\Resource;

class ExpenseResource extends Resource
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
            'item' => ExpenseItem::find($this->expense_item_id),
            'expensed_by'=> [
                'name'=>User::find($this->expense_by)->name,
                'email'=>User::find($this->expense_by)->email,
            ],
            'quantity'=> $this->quantity,
            'price'=>$this->price,
            'details'=> $this->details,
            'created_at'=> $this->created_at->format('Y:m:d H:i:s'),
            'updated_at'=> $this->updated_at->format('Y:m:d H:i:s')

        ];
    }
}
