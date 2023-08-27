<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'allowed_products' => ['required', 'array'],
            'allowed_products.*' => ['required', 'array:name'],
            'allowed_products.*.name' => ['required', 'string', 'max:255'],
            'details' => ['nullable', 'string', 'max:255'],
        ];
    }
}
