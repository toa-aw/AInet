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
            'type' => 'nullable',
            'date' => 'required|date_format:Y-m-d',
            'value' => 'required|numeric|min:0.01',
            'description' => 'nullable|string',
            'document_file' => 'nullable|file|mimes:jpeg,png,pdf',
            'document_description' => 'nullable|string',  
        ];
    }

    public function withValidator($validator)
    {        
        $validator->after(function ($validator) {            
            if (!isset($this->document_file) && isset($this->document_description)) {
                $validator->errors()->add('document_description', 'Document file is not set.');
            }
        });
    }
}
