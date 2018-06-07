<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMovementRequest extends FormRequest
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
            'movement_category_id' => 'required|exists:movement_categories,id',
            'type' => ['required', Rule::in(['revenue','expense']), ],
            'date' => 'required|date_format:Y-m-d',
            'value' => 'required|numeric',
            'description' => 'nullable',
        ];
    }
}
