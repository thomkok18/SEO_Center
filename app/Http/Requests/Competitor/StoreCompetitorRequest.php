<?php

namespace App\Http\Requests\Competitor;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompetitorRequest extends FormRequest
{
    protected $errorBag = 'competitorError';

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
            'url' => 'required|string|max:500',
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
            'url' => __('website.url'),
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
            'url.required' => __('validation.required'),

            'url.string' => __('validation.string'),

            'url.max:500' => __('validation.max.string'),
        ];
    }
}
