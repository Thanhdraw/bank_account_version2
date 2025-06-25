<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
class TransferRequest extends FormRequest
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
            'to_account_id' => ['required', 'numeric', 'exists:accounts,account_number'],
            'amount' => ['required', 'numeric'],
            'notes' => ['nullable', 'string'],
            'transaction_password' => ['required']
        ];
    }
    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $senderAccount = request()->route('number');
            $receiverAccount = $this->input('to_account_id');

            if ($senderAccount === $receiverAccount) {
                $validator->errors()->add('to_account_id', 'Không thể chuyển tiền cho chính mình');
            }
        });
    }

    public function messages(): array
    {
        return [
            'to_account_id.required' => 'Vui lòng nhập số tài khoản nhận.',
            'to_account_id.numeric' => 'Số tài khoản nhận phải là số.',
            'to_account_id.exists' => 'Tài khoản nhận không tồn tại.',
            'amount.required' => 'Vui lòng nhập số tiền.',
            'amount.numeric' => 'Số tiền phải là số.',
            'amount.min' => 'Số tiền tối thiểu là 1000.',
        ];
    }
}