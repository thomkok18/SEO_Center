<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'role_id' => 'required|integer',
            'language_id' => 'required|integer',
            'status_id' => 'required|integer',
            'company_id' => 'required|integer',
            'firstname' => 'required|string|max:50',
            'inserts' => 'nullable|string|max:50',
            'lastname' => 'required|string|max:50',
            'phone' => 'nullable|string|max:20',
            'email' => 'unique:users,email, '. auth()->id() .'|required|email|max:50',
            'password' => 'required|string|max:255',
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
            'role_id' => __('user.role'),
            'language_id' => __('user.language'),
            'status_id' => __('user.status'),
            'company_id' => __('user.company'),
            'firstname' => __('user.first_name'),
            'inserts' => __('user.inserts'),
            'lastname' => __('user.last_name'),
            'phone' => __('user.phone_number'),
            'email' => __('user.email'),
            'password' => __('user.password'),
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

            'role_id.required' => __('validation.required'),
            'language_id.required' => __('validation.required'),
            'status_id.required' => __('validation.required'),
            'company_id.required' => __('validation.required'),
            'firstname.required' => __('validation.required'),
            'lastname.required' => __('validation.required'),
            'email.required' => __('validation.required'),
            'password.required' => __('validation.required'),

            'role_id.integer' => __('validation.integer'),
            'language_id.integer' => __('validation.integer'),
            'status_id.integer' => __('validation.integer'),
            'company_id.integer' => __('validation.integer'),
            'firstname.string' => __('validation.string'),
            'inserts.string' => __('validation.string'),
            'lastname.string' => __('validation.string'),
            'email.email' => __('validation.email'),
            'phone.string' => __('validation.string'),
            'password.string' => __('validation.string'),

            'firstname.max:50' => __('validation.max.numeric'),
            'inserts.max:50' => __('validation.max.numeric'),
            'lastname.max:50' => __('validation.max.numeric'),
            'email.max:50' => __('validation.max.numeric'),
            'phone.max:20' => __('validation.max.numeric'),
            'password.max:255' => __('validation.max.numeric'),
        ];
    }
}
