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
            'english.required' => __('dictionary.validation.word_too_long'),
            'russian.required' => __('dictionary.validation.word_wasnt_entered'),
            'english.max' => __('dictionary.validation.word_must_be_latin'),
            'russian.max' => __('dictionary.validation.translation_too_long'),
            'english.regex' => __('dictionary.validation.translation_wasnt_entered'),
            'russian.regex' => __('dictionary.validation.translation_must_be_cyrillic'),
        ];
    }
}
