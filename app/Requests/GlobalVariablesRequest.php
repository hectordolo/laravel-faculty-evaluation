<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GlobalVariablesRequest extends FormRequest
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
                    'name' => 'required|max:25|unique:global_variables,name',
                    'value' => 'required|max:5'
                ];
            }
            case 'PATCH':
            {
                return [
                    'name' => 'required|max:25|unique:global_variables,name,'. $this->segment(3),
                    'value' => 'required|max:5'
                ];
            }
        }
    }
}