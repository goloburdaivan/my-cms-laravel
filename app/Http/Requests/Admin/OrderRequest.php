<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => [],
            'name' => [],
            'phone' => [],
            'address' => [],
            'email' => [],
            'status' => [],
            'total_price' => [],
        ];
    }
}
