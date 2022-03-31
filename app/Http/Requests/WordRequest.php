<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WordRequest extends FormRequest
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
            'english' => ['required', 'max:25', 'regex:/^[a-zA-ZÄäÖöẞßÜü,.\-\s]+$/u'],
            'russian' => ['required', 'max:25', 'regex:/^[а-яА-ЯёЁ,.\-\s]+$/u'],
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
            'english.required' => 'Не передано слово',
            'russian.required' => 'Не передан перевод слова',
            'english.max' => 'Слово слишком длинное',
            'russian.max' => 'Перевод слишком длинный',
            'english.regex' => 'Слово должно состоять из букв латиницы',
            'russian.regex' => 'Перевод должен состоять из букв кириллицы',
        ];
    }
}
