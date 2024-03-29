<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title'=>'required|string|max:100',
            'body'=>'required|string|max:4000',
            'url' => ['required', 'url', 'starts_with:https://'],
        ];
    }
}
