<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GrammarRequest extends FormRequest
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
            'name' => ['required', 'max:100', 'string', Rule::unique('grammars')->ignore($this->route()->parameter('grammar'))],
            'description' => ['required', 'string'],
            'level' => ['required', 'string'],
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
        ];
    }
}
