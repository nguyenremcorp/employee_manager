<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserProfileRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'department' => ['nullable', 'integer', 'exists:departments,id'],
            'role' => [
                'nullable',
                'string',
                Rule::in(get_values('user_role')),
                function ($attribute, $value, $fail) {
                    if (
                        $value &&
                        !Auth::user()->isAdmin
                    ) {
                        $fail('Bạn không có quyền update vai trò');
                    }
                }
            ],
            'gender' => ['nullable', 'string', Rule::in(get_values('gender'))],
            'marital_status' => ['nullable', Rule::in(get_values('marital'))],
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
            'department.exists' => 'Phòng ban bạn vừa chọn không tồn tại.',
            'department.int' => 'Giá trị chọn phòng ban phải là số nguyên',
            'gender' => 'Giới tính không hợp lệ',
            'role.in' => 'Vai trò không hợp lệ.',
            'marital_status' => 'Tình trạng hôn nhân không hợp lệ. '
        ];
    }
}
