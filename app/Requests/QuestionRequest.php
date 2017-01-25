<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
                    'name' => 'required|max:25|unique:questions,name',
                    'for_id' => 'required|max:15',
                    'active' => 'max:2'
                ];
            }
            case 'PATCH':
            {
                return [
                    'name' => 'required|max:25|unique:questions,name,'. $this->segment(3),
                    'for_id' => 'required|max:15',
                    'active' => 'max:2'
                ];
            }
        }
    }
}