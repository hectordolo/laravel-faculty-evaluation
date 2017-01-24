<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
            'name' => 'required|max:255',
            'percentage' => 'required|max:25',
            'priority' => 'max:10',
            'active' => 'max:10',
            'for_id' => 'max:15'
        ];
    }
}