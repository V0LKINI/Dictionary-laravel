<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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
            'name' => ['required', 'max:20', 'string'],
            'email' => ['required', 'email', Rule::unique('users')->ignore(Auth::id())],
            'image' => ['image'],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Не передано имя',
            'name.max' => 'Имя должно быть не длиннее 20 символов',
            'email.required' => 'Не передан email',
            'email.unique' => 'Email уже используется',
            'image' => 'Неверный формат изображения',
        ];
    }
}
