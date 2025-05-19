<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    protected $errorBag = 'userError';

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
            'firstname' => 'required|string|max:50',
            'inserts' => 'nullable|string|max:50',
            'lastname' => 'required|string|max:50',
            'phone' => 'nullable|string|max:20',
            'email' => 'unique:users,email, '. auth()->id() .'|required|email|max:50',
            'language_id' => 'required|integer',
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
            'firstname' => __('user.first_name'),
            'inserts' => __('user.inserts'),
            'lastname' => __('user.last_name'),
            'phone' => __('user.phone_number'),
            'email' => __('user.email'),
            'language_id' => __('user.language'),
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
            'email.unique' => __('validation.unique'),

            'firstname.required' => __('validation.required'),
            'lastname.required' => __('validation.required'),
            'email.required' => __('validation.required'),
            'language_id.required' => __('validation.required'),

            'firstname.string' => __('validation.string'),
            'inserts.string' => __('validation.string'),
            'lastname.string' => __('validation.string'),
            'email.string' => __('validation.string'),
            'phone.string' => __('validation.string'),
            'language_id.integer' => __('validation.integer'),

            'firstname.max:50' => __('validation.max.numeric'),
            'inserts.max:50' => __('validation.max.numeric'),
            'lastname.max:50' => __('validation.max.numeric'),
            'email.max:50' => __('validation.max.numeric'),
            'phone.max:20' => __('validation.max.numeric'),
        ];
    }
}
