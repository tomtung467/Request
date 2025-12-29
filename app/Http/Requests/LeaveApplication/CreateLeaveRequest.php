<?php
namespace App\Http\Requests\LeaveRequest;
use App\Http\Requests\BaseRequest;
use App\Rules\NoOverlapDates;
class CreateLeaveRequest extends BaseRequest
{
    public function rules()
    {

        return [
        'user_id'    => 'required|exists:users,id',
        'start_date' => ['required','date'],
        'end_date'   => ['required','date','after_or_equal:start_date'],
        'reason'     => 'required|string|max:500',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'User ID is required.',
            'user_id.exists' => 'The specified user does not exist.',
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
}
