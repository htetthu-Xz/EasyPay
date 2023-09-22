<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserRequest extends FormRequest
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
        if($this->method() == 'POST') {
            return [
                'name' => 'required',
                'email' => 'required|email|unique:admin_users,email',
                'password' => 'required|min:8',
                'phone' => 'required|unique:admin_users,phone'
            ];
        } else {
            return [
                'name' => 'required',
                'email' => 'required|email|unique:admin_users,email,' . $this->admin_user->id,
                'password' => 'nullable',
                'phone' => 'required|unique:admin_users,phone,' . $this->admin_user->id
            ];
        }
    }
}
