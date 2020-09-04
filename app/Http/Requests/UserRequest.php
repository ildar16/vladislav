<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $rules = [
            'first_name' => 'required|string|max:30',
            'last_name' => 'required|string|max:30',
            'email' => 'required|string|email|unique:users|max:30',
            'gender' => 'required|string|max:30',
            'birthday' => 'required|date_format:Y/m/d',
        ];

        switch ($this->getMethod())
        {
            case 'POST':
              return $rules;
            case 'PUT':
              return [
                'id' => 'required|integer|exists:users,id',
                'email' => 'unique:users,email,' . $this->user,
              ] + $rules;
            case 'DELETE':
              return [
                  'id' => 'required|integer|exists:users,id'
              ];
        }
    }
}
