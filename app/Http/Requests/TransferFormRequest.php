<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferFormRequest extends FormRequest
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
                'to_phone' => 'required|numeric',
                'amount' => 'required|numeric|min:1000',
                'description' => 'nullable'
            ];
    }

    public function messages() 
    {
        return [
            'to_phone.required' => 'Please fill phone number to transfer.',
            'to_phone.numeric' => 'Please fill valid phone number.',
            'amount.required' => 'Please fill money amount to transfer.',
            'amount.numeric' => 'Please fill transfer amount.',
            'amount.min' => 'The amount must be at least 1000 MMK.'
        ];
    }
}
