<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class UserRequest extends FormRequest
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

        switch($this->method())
        {
            case 'POST':
            {
                return [
                    'sjc_id' => 'required|max:50',
                    'first_name' => 'required|max:100',
                    'last_name' => 'required|max:100',
                    'username' => 'required|min:6|unique:users,username',
                    'password' => 'required|min:6|confirmed',
                    'password_confirmation' => 'required|min:6',
                    'school_code' => 'max:20',
                    'type' => 'max:20',
                    'course' => 'max:20',
                    'school_of' => 'max:20',
                    'semester' => 'max:20',
                    'school_year' => 'max:20'
                ];
            }
            case 'PATCH':
            {
                return [
                    'sjc_id' => 'required|max:50',
                    'first_name' => 'required|max:100',
                    'last_name' => 'required|max:100',
                    'username' => 'required|min:6|unique:users,username,'. $this->segment(3),
                    'password' => 'min:6|confirmed',
                    'password_confirmation' => 'min:6',
                    'school_code' => 'max:20',
                    'type' => 'max:20',
                    'course' => 'max:20',
                    'school_of' => 'max:20',
                    'semester' => 'max:20',
                    'school_year' => 'max:20'
                ];
            }
        }
    }
}
