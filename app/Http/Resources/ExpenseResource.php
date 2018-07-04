<?php

namespace App\Http\Resources;

use App\Http\Resources\Items\ItemCollectionResoruce;
use App\Models\ExpenseItem;
use App\Models\Item;
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
            'details'=> $this->details,
            'amount'=> $this->amount
        ];
    }
}
