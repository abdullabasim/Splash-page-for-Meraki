<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyCode extends FormRequest
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
//            'verify_code' => 'required|numeric|digits:6',
//            'phone_number' => 'required'

        ];
    }

    public function messages()
    {
        return [
//            'verify_code.required' => 'The Verify code Required.',
//            'verify_code.digits' => 'The Phone Number digit  must be equal to 6.',
//            'phone_number.required' => 'The Phone Number Required.',

        ];
    }
}
