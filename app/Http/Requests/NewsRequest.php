<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'title' => ['required', 'max:20', 'string'],
            'code' => ['required', 'max:20', 'string'],
            'description' => ['required', 'string'],
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
            'title.required' => 'Не передано имя',
            'title.max' => 'Имя должно быть не длиннее 20 символов',
            'code.required' => 'Не передан email',
            'code.unique' => 'Email уже используется',
            'image' => 'Неверный формат изображения',
        ];
    }
}
