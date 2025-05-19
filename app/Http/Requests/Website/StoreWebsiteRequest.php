<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;

class StoreWebsiteRequest extends FormRequest
{
    protected $errorBag = 'websiteError';

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
            'url' => 'required|string|unique:websites,url|max:500',
            'startdate' => 'required|date||after:this month',
            'enddate' => 'required|date|after_or_equal:startdate',
            'amount' => 'required|numeric|min:0',
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
            'startdate' => __('budget.start_date'),
            'enddate' => __('budget.end_date'),
            'amount' => __('budget.amount'),
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
            'startdate.required' => __('validation.required'),
            'enddate.required' => __('validation.required'),
            'amount.required' => __('validation.required'),

            'url.string' => __('validation.string'),
            'startdate.date' => __('validation.date'),
            'enddate.date' => __('validation.date'),
            'amount.numeric' => __('validation.numeric'),

            'url.unique' => __('validation.unique'),

            'url.max:500' => __('validation.max.string'),
            'amount.min:0' => __('validation.min.numeric'),
        ];
    }
}
