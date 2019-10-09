<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginPost extends FormRequest
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
            'txtEmail' => 'required|email',
            'txtPass' => 'required'
        ];
    }

    /**
     * thong bao loi 
     */
    
    public function messages()
    {
        return [
            'txtEmail.required' => 'Email khong duoc trong',
            'txtEmail.email' => 'Dinh dang email khong dung',
            'txtPass.required' => 'Vui long nhap mat khau '
        ];
    }
}
