<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AdminCreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * 
     * @return boolean
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'role' => [
                'required',
                'string',
                Rule::in(get_values('user_role'))
            ],
            'password' => [
                'required',
                'string',
                Password::min(8)->mixedCase()->numbers()
            ],
            'department' => ['nullable', 'integer', 'exists:departments,id'],
            'gender' => [
                'nullable',
                'string',
                Rule::in(get_values('gender'))
            ],
            'marital_status' => [
                'nullable',
                Rule::in(get_values('marital'))
            ],
            'address' => ['nullable'],
            'date_of_birth' => ['nullable', 'date'],
            'phone' => ['nullable', 'regex:/^[0-9]{9,11}$/'],
            'position' => ['nullable'],
            'cccd' => ['nullable'],
            'cccd_date' => ['nullable', 'date'],
            'start_date' => ['nullable', 'date'],
        ];
    }

    /**
     * Display messages validation
     * 
     * @return array
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email này đã được đăng ký.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.numbers' => 'Mật khẩu phải có ít nhất 1 chữ số.',
            'name.required' => 'Vui lòng nhập tên user',
            'role' => 'Vai trò không hợp lệ',
            'phone' => 'Số điện thoại không hợp lệ',
            'department.exists' => 'Phòng ban bạn vừa chọn không tồn tại.',
            'department.int' => 'Giá trị chọn phòng ban phải là số nguyên',
            'gender' => 'Giới tính không hợp lệ',
            'role.in' => 'Vai trò không hợp lệ.',
            'marital_status' => 'Tình trạng hôn nhân không hợp lệ. '
        ];
    }
}
