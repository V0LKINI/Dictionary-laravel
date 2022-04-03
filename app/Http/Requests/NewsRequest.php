<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'title' => ['required', 'max:100', 'string'],
            'code' => ['required', 'max:100', 'string', Rule::unique('news')->ignore($this->route()->parameter('news'))],
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
            'required' => 'Не передано поле :attribute',
            'max' => 'Поле :attribute должно быть не длиннее :max символов',
            'string' => 'Поле :attribute должно быть строкой',
            'unique' => 'Поле :attribute должно быть уникальным',
            'image' => 'Неверный формат изображения',
        ];
    }
}
