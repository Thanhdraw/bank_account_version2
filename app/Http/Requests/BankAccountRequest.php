<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Enums\TypeAccount;

class BankAccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fullname' => 'required|string|max:255',
            'email' => 'nullable|email|unique:customers,email',
            'type' => ['required', new Enum(TypeAccount::class)],
            'phone' => 'nullable|string|max:15|unique:customers,phone',
            'password' => 'required|string|min:6',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'Email đã tồn tại trong hệ thống.',
            'phone.unique' => 'Số điện thoại đã được sử dụng.',
            'type.required' => 'Vui lòng chọn loại tài khoản.',
        ];
    }

}