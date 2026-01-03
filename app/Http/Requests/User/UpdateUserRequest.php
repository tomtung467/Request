<?php
namespace App\Http\Requests\User;
use App\Http\Requests\BaseRequest;
class UpdateUserRequest extends BaseRequest
{
    //
    public function rules()
    {
        return [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $this->route('id'),
            'password' => 'nullable|string|min:8|confirmed',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$this->filled('name') && !$this->filled('email') && !$this->filled('password')) {
                $validator->errors()->add('fields', 'At least one field (name, email, or password) must be provided.');
            }
        });
    }
    public function messages()
    {
        return [
            'name.string' => __('validation.string',['Attribute'=>__('name')]),
            'name.max' => __('validation.max.string',['Attribute'=>__('name'),'max'=>255]),
            'email.email' => __('validation.email',['Attribute'=>__('email')]),
            'email.unique' => __('validation.unique',['Attribute'=>__('email')]),
            'password.min' => __('validation.min.string',['Attribute'=>__('password'),'min'=>8]),
            'password.confirmed' => __('validation.confirmed',['Attribute'=>__('password')]),
        ];
    }
    public function prepareForValidation()
    {
        //
    }
}
