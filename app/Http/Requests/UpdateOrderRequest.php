<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->order->user_id === $this->user()->id;
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
            'allowed_products.*' => ['required', 'array:name'],
            'allowed_products.*.name' => ['required', 'string', 'max:255'],
            'details' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * Handle a passed validation attempt.
     */
    public function passedValidation(): void
    {
        $this->merge([
            'allowed_products' => collect($this->allowed_products)
                ->pluck('name')
                ->map(fn (string $name) => Str::transliterate($name))
                ->map(fn (string $name) => Str::lower($name))
                ->map(fn (string $name) => Product::firstOrCreate(['name' => $name]))
                ->pluck('id')
                ->toArray(),
        ]);
    }
}
