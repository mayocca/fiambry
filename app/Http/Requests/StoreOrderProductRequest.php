<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrderProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => [
                'required',
                Rule::unique('order_product', 'product_id')->where('order_id', $this->order->id)->where('user_id', $this->user()->id),
                Rule::exists('allowed_products', 'product_id')->where('order_id', $this->order->id),
            ],
            'quantity' => ['required', 'integer', 'min:1'],
        ];
    }
}
