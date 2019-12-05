<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'current_password'  =>  [
                'required',
                function($attr, $value, $fail) {
                    if(!password_verify($value, \Auth::user()->password))
                        return $fail('Current Password doesn\'t match');
                }
            ],
            'password'  =>  'required|min:6|confirmed',
            'password_confirmation' =>  'required'
        ];
    }
}
