<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseInvoiceRequest extends FormRequest
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
            'code'=> 'required',
            'items'=> 'required|min:1',
            'items.*.item.id'=> 'required|numeric',
            'items.*.item.quantity'=> 'required|numeric',
            'items.*.item.purchase_price'=> 'required|numeric',
            'items.*.item.sell_price'=> 'required|numeric',
            'supplier.id'=> 'required|numeric'
        ];
    }
}
