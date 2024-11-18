<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'required'],
            'slug' => ['string', 'required'],
            'price' => ['decimal:2', 'required'],
            'description' => ['string', 'required'],
            'category_id' => ['integer', 'required'],
            'article' => ['string', 'required'],
        ];
    }
}
