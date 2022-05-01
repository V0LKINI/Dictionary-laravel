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
            'name.required' => __('profile.validation.name_required'),
            'name.max' =>  __('profile.validation.name_max'),
            'email.required' =>  __('profile.validation.email_required'),
            'email.unique' =>  __('profile.validation.email_unique'),
            'image' =>  __('profile.validation.image'),
        ];
    }
}
