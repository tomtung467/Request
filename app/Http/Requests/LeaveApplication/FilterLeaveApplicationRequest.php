<?php

namespace App\Http\Requests\LeaveApplication;

use Illuminate\Foundation\Http\FormRequest;

class FilterLeaveApplicationRequest extends FormRequest
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
            //
            'status' => 'nullable|in:0,1,2,3',
            'month' => 'nullable|integer|min:1|max:12',
            'year' => 'nullable|integer|min:2000|max:2100',
            'user_id' => 'nullable|exists:users,id',
        ];
    }
    public function messages()
    {
        return [
            'status.in' => __('validation.in',['Attribute'=>__('status'),'values'=>'pending, approved, rejected, cancelled']),
            'month.integer' => __('validation.integer',['Attribute'=>__('month')]),
            'month.min' => __('validation.min.numeric',['Attribute'=>__('month'),'min'=>1]),
            'month.max' => __('validation.max.numeric',['Attribute'=>__('month'),'max'=>12]),
            'year.integer' => __('validation.integer',['Attribute'=>__('year')]),
            'year.min' => __('validation.min.numeric',['Attribute'=>__('year'),'min'=>2000]),
            'year.max' => __('validation.max.numeric',['Attribute'=>__('year'),'max'=>2100]),
            'user_id.exists' => __('validation.exists',['Attribute'=>__('user id')]),
        ];
    }
}
