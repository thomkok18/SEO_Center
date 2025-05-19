<?php

namespace App\Http\Requests\Import;

use Illuminate\Foundation\Http\FormRequest;

class CsvImportRequest extends FormRequest
{
    protected $errorBag = 'csvError';

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
            'data' => 'required|file|mimes:csv'
        ];
    }
}
