<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DaysRequest extends FormRequest
{
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
            'day' => 'array|max:6',
            'start`' => 'array|max:6',
            'end' => 'array|max:6',
            'day.*' => 'required|exists:days,id|distinct',
            'start.*' => 'nullable|date_format:H:i',
            'end.*' => 'nullable|date_format:H:i|after:start.*',

        ];
    }

    public function messages()
    {
        return [
            'day.*.required' => 'The day is required',
            'day.*.exists' => 'Invalid day',
            'day.*.distinct' => 'Duplicate values not allowed',
            'start.*.date_format' => 'Invalid time format',
            'end.*.date_format' => 'Invalid time format',
            'end.*.after' => 'End must be after start',
        ];
    }
}
