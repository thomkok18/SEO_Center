<?php

namespace App\Http\Requests\Crawler;

use Illuminate\Foundation\Http\FormRequest;

class StoreMailRequest extends FormRequest
{
    protected $errorBag = 'mailtoError';

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
            'email' => 'unique:users,email|required|email|max:50',
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
            'email' => __('user.email'),
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

            'firstname.string' => __('validation.string'),
            'inserts.string' => __('validation.string'),
            'lastname.string' => __('validation.string'),
            'email.email' => __('validation.email'),

            'firstname.max:50' => __('validation.max.numeric'),
            'inserts.max:50' => __('validation.max.numeric'),
            'lastname.max:50' => __('validation.max.numeric'),
            'email.max:50' => __('validation.max.numeric'),
        ];
    }
}
