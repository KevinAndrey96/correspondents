<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTransactionRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'productID' => 'required|numeric',
            'accountNumber' => 'required|string',
            'amount' => 'required|numeric',
            'type' => 'required|string',
            'status' => 'required|string',
            'detail' => 'string',
            'date' => 'required',
            //'ownCommission' => 'numeric'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'El :attribute es obligatorio.'
        ];
    }

}
