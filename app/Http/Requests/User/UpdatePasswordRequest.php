<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    protected $errorBag = 'passwordError';

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
            'current_password' => 'required|password|string|max:255',
            'password' => 'required|string|max:255',
            'repeat_password' => 'required|same:password|string|max:255',
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
            'current_password' => __('user.current_password'),
            'password' => __('user.new_password'),
            'repeat_password' => __('user.repeat_password'),
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'current_password.required' => __('validation.required'),
            'password.required' => __('validation.required'),
            'repeat_password.required' => __('validation.required'),

            'current_password.password' => __('validation.password'),
            'repeat_password.same' => __('validation.same'),

            'current_password.string' => __('validation.string'),
            'password.string' => __('validation.string'),
            'repeat_password.string' => __('validation.string'),

            'current_password.max:255' => __('validation.max.numeric'),
            'password.max:255' => __('validation.max.numeric'),
            'repeat_password.max:255' => __('validation.max.numeric'),
        ];
    }
}
