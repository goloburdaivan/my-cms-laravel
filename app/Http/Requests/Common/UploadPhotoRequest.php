<?php

namespace App\Http\Requests\Common;

use Illuminate\Foundation\Http\FormRequest;

class UploadPhotoRequest extends FormRequest
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
            'model' => ['string', 'required'],
            'model_id' => ['integer', 'required'],
            'image' => ['file', 'mimes:jpg,jpeg,png', 'max:10240', 'required'],
        ];
    }
}
