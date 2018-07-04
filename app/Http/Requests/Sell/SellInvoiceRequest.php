<?php

namespace App\Http\Requests\Sell;

use Illuminate\Foundation\Http\FormRequest;

class SellInvoiceRequest extends FormRequest
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
            'sell_items'=> 'required|min:1',
            'sell_items.*.item.id'=> 'required|numeric',
            'sell_items.*.item.quantity'=> 'required|numeric',
            'sell_items.*.item.sell_price'=> 'required|numeric',
            'sell_items.discount'=> 'numeric|max:40|nullable',
            'vat'=> 'numeric|nullable'
        ];
    }
}
