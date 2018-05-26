<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordRequest extends FormRequest
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
            'old_password' => 'required',
            'password' => 'required|string|min:3|confirmed',      
        ];
    }

    public function withValidator($validator)
    {
        
        $validator->after(function ($validator) {
            // $user = \Route::current()->parameter('user');
            $user = Auth::user();
            if (!Hash::check($this->old_password, $user->password)) {
                $validator->errors()->add('old_password', 'Password is incorrect.');
            }
        });
    }
}
