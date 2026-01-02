<?php
namespace App\Http\Requests\User;
use App\Http\Requests\BaseRequest;
class UpdateUserRequest extends BaseRequest
{
    //
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => __('validation.required',['Attribute'=>__('name')]),
            'email.required' => __('validation.required',['Attribute'=>__('email')]),
            'email.email' => __('validation.email',['Attribute'=>__('email')]),
            'email.unique' => __('validation.unique',['Attribute'=>__('email')]),
            'password.required' => __('validation.required',['Attribute'=>__('password')]),
            'password.min' => __('validation.min.string',['Attribute'=>__('password'),'min'=>8]),
            'password.confirmed' => __('validation.confirmed',['Attribute'=>__('password')]),
        ];
    }
    public function prepareForValidation()
    {
        //
    }
}
