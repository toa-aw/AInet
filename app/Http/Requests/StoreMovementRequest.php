<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\MovementCategory;

class StoreMovementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // $account = Account::find($this->route('account'));

        // return $account && $this->user()->can('createMovement', $account);
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
            'value' => 'required|numeric|gt:0',
            'description' => 'nullable|string',
            'document_file' => 'nullable|file|mimes:jpeg,png,pdf',
            'document_description' => 'nullable|string',          
        ];
    }

    // public function withValidator($validator)
    // {        
    //     $validator->after(function ($validator) {
    //         $account = \Route::current()->parameter('account');
    //         /*if ($this->type != $category->type) {
    //             $validator->errors()->add('type', 'Movement type not equal to category type');
    //         }*/
    //         if ($account->id != $this->account_id) {
    //             //dd($this->account_id);
    //             $validator->errors()->add('account_id', 'Invalid account id');
    //         }
    //         if($this->value <= 0){
    //             $validator->errors()->add('value', 'Negative value or equals to 0');
    //         }
    //     });
    // }
}
