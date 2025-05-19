<?php

namespace App\Http\Requests\SEO;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePromotionUrl extends FormRequest
{
    protected $errorBag = 'promotionUrlCheckError';

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
            'conclusionRadios' => 'required|integer',
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
            'conclusionRadios' => __('check.conclusion'),
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
            'conclusionRadios.required' => __('validation.required'),

            'conclusionRadios.integer' => __('validation.integer'),
        ];
    }
}
