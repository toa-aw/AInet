<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreAccountRequest extends FormRequest
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
        //$user = Auth::user();
        return [
            'account_type_id' => 'required|exists:account_types,id',
            'date' => 'date_format:Y-m-d',  
            'code' => ['required', 
                        Rule::unique('accounts')->where(function ($query){
                            return $query->where('owner_id', Auth::user()->id);
                        }),
                    ],         
            'description' => 'nullable',            
            'start_balance' => 'required|numeric',
        ];
    }
}
