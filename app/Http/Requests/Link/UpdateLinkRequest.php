<?php

namespace App\Http\Requests\Link;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLinkRequest extends FormRequest
{
    protected $errorBag = 'linkError';

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
            'website' => 'required|string|max:500',
            'anchor_text' => 'required|string|unique:links,anchor_text,NULL,anchor_url|max:100',
            'anchor_url' => 'required|string|unique:links,anchor_text,NULL,anchor_url|max:500',
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
            'website' => __('link.website'),
            'anchor_text' => __('link.anchor_text'),
            'anchor_url' => __('link.anchor_url'),
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
            'website.required' => __('validation.required'),
            'anchor_text.required' => __('validation.required'),
            'anchor_url.required' => __('validation.required'),

            'website.string' => __('validation.string'),
            'anchor_text.string' => __('validation.string'),
            'anchor_url.string' => __('validation.string'),

            'website.max:500' => __('validation.max.numeric'),
            'anchor_text.max:100' => __('validation.max.numeric'),
            'anchor_url.max:500' => __('validation.max.numeric'),
        ];
    }
}
