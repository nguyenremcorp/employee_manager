<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use App\enum\MaritalStatus;
use App\enum\Gender;
use Illuminate\Foundation\Http\FormRequest;

class SearchUserRequest extends FormRequest
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
            'keyword' => ['nullable', 'string', 'max:255'],
            'search_by' => ['nullable', Rule::in(['name', 'email', 'phone'])],
            'page'  => ['nullable', 'integer', 'min:1'],
            'department' => ['nullable', 'integer', 'exists:departments,id'],
            'gender' => ['nullable', 'string', Rule::in(Gender::values())],
            'marital_status' => ['nullable', Rule::in(MaritalStatus::values())],
        ];
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    public function messages()
    {
        return [
            'keyword' => 'Từ khóa không hợp lệ (0-255 ký tự)',
            'search_by' => 'Điều kiện search không hợp lệ. Vui lòng chọn search theo tên hoặc email hoặc phone.',
            'department.exists' => 'Phòng ban bạn vừa chọn không tồn tại.',
            'department.int' => 'Giá trị chọn phòng ban phải là số nguyên',
            'gender' => 'Giới tính không hợp lệ',
            'role.in' => 'Vai trò không hợp lệ.',
            'marital_status' => 'Tình trạng hôn nhân không hợp lệ. '
        ];
    }
}
