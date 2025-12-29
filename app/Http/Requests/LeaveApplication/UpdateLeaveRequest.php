<?php
namespace App\Http\Requests\LeaveApplication;
use App\Http\Requests\BaseRequest;
use App\Models\LeaveRequest;

class UpdateLeaveRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:500',
        ];
    }
    public function messages()
    {
        return [
            'start_date.required' => 'Start date is required.',
            'start_date.date' => 'Start date must be a valid date.',
            'end_date.required' => 'End date is required.',
            'end_date.date' => 'End date must be a valid date.',
            'end_date.after_or_equal' => 'End date must be after or equal to start date.',
            'reason.required' => 'Reason for leave is required.',
            'reason.string' => 'Reason must be a valid string.',
            'reason.max' => 'Reason may not be greater than 500 characters.',
        ];
    }
    public function prepareForValidation()
    {
        //
    }
    // public function authorize()
    // {
    //     $leaveRequest = LeaveRequest::find($this->route('id'));
    //     if (!$leaveRequest) {
    //         return false;
    //     }
    //     return $this->user()->id === $leaveRequest->user_id;
    // }
}
