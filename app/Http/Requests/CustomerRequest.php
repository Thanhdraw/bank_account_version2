<?php

namespace App\Http\Requests;

use App\Enums\GenderCustomer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'digits_between:9,15'],
            'address' => ['nullable', 'string', 'max:255'],
            'birth_day' => ['nullable', 'date'],
            'gender' => ['required', new Enum(GenderCustomer::class)]
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => 'Họ tên là bắt buộc.',
            'email.required' => 'Email là bắt buộc.',
            'email.string' => 'Email không đúng định dạng.',
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'phone.digits_between' => 'Số điện thoại phải từ 9 đến 15 chữ số.',
            'phone.numeric' => 'Số điện thoại phải là số.',
            'address.max' => 'Địa chỉ tối đa 255 ký tự.',
        ];
    }
}