<?php

namespace App\Http\Requests\LeaveApplication;

use Illuminate\Foundation\Http\FormRequest;

class RejectLeaveApplicationRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'reason' => 'required|string|max:500',
        ];
    }
    public function messages()
    {
        return [
            'reason.required' => 'Rejection reason is required.',
            'reason.string' => 'Rejection reason must be a valid string.',
            'reason.max' => 'Rejection reason may not be greater than 500 characters.',
        ];
    }
}
