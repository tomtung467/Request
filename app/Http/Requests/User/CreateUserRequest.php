<?php
namespace App\Http\Requests\User;
use App\Http\Requests\BaseRequest;
class CreateUserRequest extends BaseRequest
{
    //
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
    public function after(): array
    {
        return [];
    }
    public function messages()
    {
        return [
            'name.required' => __('validation.required',['Attribute'=>__('name')]),
            'name.string' => __('validation.string',['Attribute'=>__('name')]),
            'name.max' => __('validation.max.string',['Attribute'=>__('name'),'max'=>255]),
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
        $this->merge([
            'email' => strtolower($this->email),
        ]);
    }
}
