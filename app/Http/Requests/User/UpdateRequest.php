<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'img' => ['nullable', 'file', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
            'name' => ['required', 'string', 'max:255'],
            'profile' => ['required', 'string', 'max:1000'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'img' => 'プロフィール画像',
            'name' => '名前',
            'profile' => 'プロフィール',
        ];
    }
}
