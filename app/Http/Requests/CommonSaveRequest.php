<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommonSaveRequest extends FormRequest
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
       //     'Code' => 'bail|required|alpha_dash|max:16',
//            'Name' => 'bail|required|email|min:2|max:2',
//            'password' => 'bail|required|min:8',
//            'password_confirmation' => 'bail|required|same:password',
        ];
    }
}
