<?php

namespace App\Http\Requests;

use App\Paper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaperListRequest extends FormRequest
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
            'scope' => 'string|' . Rule::in(Paper::AVAILABLE_SCOPES)
        ];
    }
}
