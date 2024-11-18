<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => ['string', 'required', 'max:255'],
            'published' => ['boolean', 'nullable'],
            'image' => ['image', 'nullable', 'mimes:jpeg,jpg,png', 'max:2048'],
            'sort' => ['integer', 'nullable'],
            'parent_id' => ['integer', 'nullable'],
        ];
    }
}
