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
            'products' => ['nullable', 'array'],
            'products.*' => ['array:id,quantity'],
            'products.*.id' => [
                'required',
                Rule::exists('allowed_products', 'product_id')->where('order_id', $this->order->id),
            ],
            'products.*.quantity' => ['required', 'integer', 'min:1'],
        ];
    }

    /**
     * Handle a passed validation attempt.
     */
    public function passedValidation(): void
    {
        $this->merge([
            'products' => collect($this->products)->mapWithKeys(function ($product) {
                return [$product['id'] => [
                    'quantity' => $product['quantity'],
                    'user_id' => $this->user()->id,
                ]];
            })->toArray(),
        ]);
    }
}
