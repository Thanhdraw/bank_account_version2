<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportTransactionRequest extends FormRequest
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
            'from' => [
                'nullable',
                'date',
                'before_or_equal:today',
                'required_with:to'
            ],
            'to' => [
                'nullable',
                'date',
                'after_or_equal:from',
                'before_or_equal:today',
                'required_with:from'
            ]
        ];
    }

    /**
     * Get custom validation messages
     */
    public function messages(): array
    {
        return [
            'from.date' => 'Ngày bắt đầu không hợp lệ.',
            'from.before_or_equal' => 'Ngày bắt đầu không được vượt quá ngày hiện tại.',
            'from.required_with' => 'Vui lòng chọn ngày bắt đầu khi đã chọn ngày kết thúc.',

            'to.date' => 'Ngày kết thúc không hợp lệ.',
            'to.after_or_equal' => 'Ngày kết thúc phải bằng hoặc sau ngày bắt đầu.',
            'to.before_or_equal' => 'Ngày kết thúc không được vượt quá ngày hiện tại.',
            'to.required_with' => 'Vui lòng chọn ngày kết thúc khi đã chọn ngày bắt đầu.',
        ];
    }

    /**
     * Get custom attributes for validator errors
     */
    public function attributes(): array
    {
        return [
            'from' => 'ngày bắt đầu',
            'to' => 'ngày kết thúc',
        ];
    }

    /**
     * Check if date range is provided
     */
    public function hasDateRange(): bool
    {
        $validated = $this->validated();
        return isset($validated['from'], $validated['to']);
    }
    /**
     * Get validated date range as Carbon instances
     */
    public function getDateRange(): array
    {
        if (!$this->hasDateRange()) {
            return [null, null];
        }

        return [
            \Carbon\Carbon::parse($this->validated()['from'])->startOfDay(),
            \Carbon\Carbon::parse($this->validated()['to'])->endOfDay(),
        ];
    }
}