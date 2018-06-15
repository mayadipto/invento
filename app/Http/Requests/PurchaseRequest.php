<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
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
            "code"=> 'required|unique:purchases|max:20',
            "item_id"=> 'required|integer|exists:items,id',
            "supplier_id"=> 'required|integer|exists:suppliers,id',
            "purchased_by"=> 'required|integer| exists:users,id',
            "quantity"=> 'required|integer',
            "purchase_price"=> 'required|numeric'
        ];
    }
}
