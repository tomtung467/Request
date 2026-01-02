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
            'reason.required' => __('validation.required',['Attribute'=>__('rejection reason')]),
            'reason.string' => __('validation.string',['Attribute'=>__('rejection reason')]),
            'reason.max' => __('validation.max',['Attribute'=>__('rejection reason'),'max'=>500]),
        ];
    }
}
