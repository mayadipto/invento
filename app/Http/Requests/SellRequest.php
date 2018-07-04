<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "item_id"=> 'required|integer|exists:items,id',
            "sell_by"=> 'required|integer| exists:users,id',
            "customer_id"=> 'integer|exists:customers,id',
            "quantity"=> 'required|integer',
            "sell_price"=> 'required|numeric',
            "discount"=> 'numeric|max:40'
        ];
    }
}
