<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\enum\MaritalStatus;
use App\enum\Gender;
use App\enum\UserRole;

class UpdateUserProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'department' => ['nullable', 'integer', 'exists:departments,id'],
            'role' => [
                'nullable',
                'string',
                Rule::in(UserRole::values()),
                function($attribute, $value, $fail) {
                    if (
                        $value &&
                        !Auth::user()->isAdmin
                    ) {
                        $fail('Bạn không có quyền update vai trò');
                    }
                } // Chỉ có admin mới có quyền update role của user
            ],
            'gender' => ['nullable', 'string', Rule::in(Gender::values())],
            'marital_status' => ['nullable', Rule::in(MaritalStatus::values())],
            'address' => ['nullable'],
            'date_of_birth' => ['nullable'],
            'phone' => ['nullable'],
            'position' => ['nullable'],
            'cccd' => ['nullable'],
            'cccd_date' => ['nullable'],
            'start_date' => ['nullable'],
        ];
    }

    /**
     * messages function
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'department.exists' => 'Phòng ban bạn vừa chọn không tồn tại.',
            'department.int' => 'Giá trị chọn phòng ban phải là số nguyên',
            'gender' => 'Giới tính không hợp lệ',
            'role.in' => 'Vai trò không hợp lệ.',
            'marital_status' => 'Tình trạng hôn nhân không hợp lệ. '
        ];
    }
}
