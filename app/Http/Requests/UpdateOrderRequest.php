<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
            'allowed_products' => ['required', 'array', 'min:1'],
            'allowed_products.*' => ['required', 'array:id'],
            'allowed_products.*.id' => ['required', 'exists:products,id'],
        ];
    }
}
