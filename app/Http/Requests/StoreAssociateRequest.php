<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreAssociateRequest extends FormRequest
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
            'associated_user' => 'required|exists:users,id',
        ];
    }

    public function withValidator($validator)
    {        
        $validator->after(function ($validator) {
            $user = Auth::user();
            //dd($this);
            if ($user->isAssociate($this->associated_user)) {
                $validator->errors()->add('associated_user', 'User already associated.');
            }
            if($user->id == $this->associated_user){
                $validator->errors()->add('associated_user', 'Cannot self associate.');
            }
        });
    }
}
