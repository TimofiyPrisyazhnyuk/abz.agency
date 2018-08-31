<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'surname' => 'required|string|max:15|min:3',
            'first_name' => 'required|string|max:15|min:3',
            'patronymic' => 'required|string|max:15|min:3',
            'position_id' => 'required|integer|exists:positions,id',
            'amount_of_wages' => 'required|numeric|between:3800,400000|regex:/^\d*(\.\d{1,2})?$/',
            'email' => 'required|string|email|max:255|unique:users,email,'. $this->id,
            'password' => 'required|string|min:6|confirmed',
            'boss_id' => 'integer|exists:users,id'
        ];
    }
}
