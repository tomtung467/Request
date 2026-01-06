<?php
namespace App\Http\Requests\LeaveApplication;
use App\Http\Requests\BaseRequest;
use App\Rules\NoOverlapDates;
use Attribute;

class CreateLeaveRequest extends BaseRequest
{
    public function rules()
    {

        return [
        'user_id'    => 'required|exists:users,id',
        'start_date' => 'required|date|after_or_equal:today',
        'end_date'   => 'required|date|after_or_equal:start_date',
        'reason'     => 'required|string|max:500',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => __('validation.required',['Attribute'=>__('user id')]),
            'user_id.exists' => __('validation.exists',['Attribute'=>__('user id')]),
            'start_date.required' => __('validation.required',['Attribute'=>__('start date')]),
            'start_date.date' => __('validation.date',['Attribute'=>__('start date')]),
            'start_date.after_or_equal' => __('validation.after_or_equal',['Attribute'=>__('start date'),'date'=>__('today')]),
            'end_date.required' => __('validation.required',['Attribute'=>__('end date')]),
            'end_date.date' => __('validation.date',['Attribute'=>__('end date')]),
            'end_date.after_or_equal' => __('validation.after_or_equal',['Attribute'=>__('end date'),'date'=>__('start date')]),
            'reason.required' => __('validation.required',['Attribute'=>__('reason')]),
            'reason.string' => __('validation.string',['Attribute'=>__('reason')]),
            'reason.max' => __('validation.max.string',['Attribute'=>__('reason'),'max'=>500]),
        ];
        //     'start_date.date' => 'Start date must be a valid date.',
        //     'end_date.required' => 'End date is required.',
        //     'end_date.date' => 'End date must be a valid date.',
        //     'end_date.after_or_equal' => 'End date must be after or equal to start date.',
        //     'reason.required' => 'Reason for leave is required.',
        //     'reason.string' => 'Reason must be a valid string.',
        //     'reason.max' => 'Reason may not be greater than 500 characters.',
        // ];
    }
    public function prepareForValidation()
    {
        //
    }
}
