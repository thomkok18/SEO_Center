<?php

namespace App\Http\Requests\PriceType;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePriceTypeRequest extends FormRequest
{
    protected $errorBag = 'priceTypeError';

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
            'name_en' => 'required|string|max:50',
            'name_nl' => 'nullable|string|max:50',
            'price' => 'required|numeric',
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
            'name_en' => __('promotionUrl.name'),
            'name_nl' => __('promotionUrl.name'),
            'price' => __('promotionUrl.price'),
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
            'name_en.required' => __('validation.required'),
            'price.required' => __('validation.required'),

            'name_en.string' => __('validation.string'),
            'name_nl.string' => __('validation.string'),
            'price.decimal' => __('validation.numeric'),

            'name_en.max:50' => __('validation.max.numeric'),
            'name_nl.max:50' => __('validation.max.numeric'),
        ];
    }
}
