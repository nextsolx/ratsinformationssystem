<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetMeetingsRequest extends FormRequest
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
            'from' => 'only',
            'year' => 'required_with:month|digits:4',
            'month' => 'required_with:year|between:1,12',
        ];
    }
}
