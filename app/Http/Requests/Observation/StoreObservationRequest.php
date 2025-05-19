<?php

namespace App\Http\Requests\Observation;

use Illuminate\Foundation\Http\FormRequest;

class StoreObservationRequest extends FormRequest
{
    protected $errorBag = 'observationError';

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
            'name_en' => __('observation.name'),
            'name_nl' => __('observation.name'),
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

            'name_en.string' => __('validation.string'),
            'name_nl.string' => __('validation.string'),

            'name_en.max:50' => __('validation.max.numeric'),
            'name_nl.max:50' => __('validation.max.numeric'),
        ];
    }
}
