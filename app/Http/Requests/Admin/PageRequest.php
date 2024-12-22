<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'slug' => ['string', 'required'],
            'html' => ['string', 'required'],
            'title' => ['string', 'required'],
        ];
    }
}
