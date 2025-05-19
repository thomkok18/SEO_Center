<?php

namespace App\Http\Requests\Mailto;

use Illuminate\Foundation\Http\FormRequest;

class StoreMailtoRequest extends FormRequest
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
            'company_id' => 'integer',
            'user_id' => 'nullable|integer',
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
            'company_id' => __('user.company'),
            'user_id' => __('user.user'),
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
            'company_id.integer' => __('validation.integer'),
            'user_id.integer' => __('validation.integer'),
        ];
    }
}
