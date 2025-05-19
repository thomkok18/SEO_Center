<?php

namespace App\Http\Requests\PromotionUrl;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePromotionUrlRequest extends FormRequest
{
    protected $errorBag = 'promotionUrlError';

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
            'customer_id' => 'nullable|integer',
            'promotion_url' => 'required|string|max:500',
            'url_type_id' => 'required|integer',
            'price_type_id' => 'required_without:custom_price',
            'custom_price' => 'required_without:price_type_id',
            'archived' => 'boolean',
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
            'customer_id' => __('role.customer'),
            'promotion_url' => __('promotionUrl.promotion_url'),
            'url_type_id' => __('promotionUrl.type'),
            'custom_price' => __('promotionUrl.price'),
            'price_type_id' => __('promotionUrl.price_type_id'),
            'archived' => __('promotionUrl.archived'),
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
            'promotion_url.required' => __('validation.required'),
            'url_type_id.required' => __('validation.required'),

            'customer_id.integer' => __('validation.integer'),
            'promotion_url.string' => __('validation.string'),
            'url_type_id.integer' => __('validation.integer'),
            'archived.boolean' => __('validation.boolean'),

            'promotion_url.max:500' => __('validation.max.string'),
        ];
    }
}
