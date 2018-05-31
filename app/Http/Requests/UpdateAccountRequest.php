<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateAccountRequest extends FormRequest
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
        $account = \Route::current()->parameter('account');
        return [
            'account_type_id' => 'required|exists:account_types,id',
            'date' => 'required|date_format:Y-m-d',
            'code' => 'required|unique:accounts,code,'.$account->id,            
            'description' => 'nullable',            
            'start_balance' => 'required|numeric|regex:/^-?[0-9]+(?:\.[0-9]{2})?$/',
        ];
    }
}
