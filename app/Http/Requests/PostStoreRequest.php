<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'content' => 'required | max:255',
            'date' => 'required | date',
        ];
    }

    public function attributes()
    {
        return [
            'content' => '内容',
            'date' => '日付',
        ];
    }

    public function messages()
    {
        return [
            'content.required' => ':attributeを入力してください',
            'content.max' => '128文字以内で入力してください',
            'date.required' => ':attributeを入力してください',
        ];
    }
}
