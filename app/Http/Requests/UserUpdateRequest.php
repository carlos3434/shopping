<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
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
            'name'          => 'required|string',
            'email'         => 'required|unique:users,email,'. (isset($this->user->id) ? $this->user->id : 0),
            'password'      => 'string',
            'role_type'     => 'required|in:1,2',
            'phone'         => 'required|string',
            'address'       => 'required|string'
        ];
    }

}
