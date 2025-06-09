@php
    use App\Enum\MaritalStatus;
    use App\Enum\Gender;
    use App\Enum\UserRole;
@endphp
<form method="POST" onsubmit="return confirmSubmit(this);" action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}">
    @csrf
    @if(isset($user))
        @method('PATCH')
    @else 
        @method('POST')
    @endif

    <!-- Chỉ Admin có thể đổi role cho user -->
    @if(isset($user) && auth()->user()->isAdmin && $user->id != auth()->user()->id)
    <div class="card">
        <div class="card-body">
            <h4 class="mt-0 mb-3 header-title" style="color:#2d91e1">Cấu hình sử dụng hệ thống</h4>
            <div class="row">
                <div class="col-lg-2">
                    <div class="form-group">
                        <label>Vai trò</label>
                        <select name="role" class="form-control mb-2">
                            @foreach(UserRole::options() as $key => $role)
                                <option value="{{ $key }}" {{ old('role', $user->role ?? '') == $key ? 'selected' : '' }}>
                                    {{ $role }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Trường hợp tạo mới user -->
    <!-- Thông tin đăng nhập -->
    @if(!isset($user))
    <div class="card">
        <div class="card-body">
            <h4 class="mt-0 mb-4 header-title" style="color:#2d91e1">Thông tin đăng nhập</h4>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Email*</label>
                        <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" class="form-control mb-2" placeholder="Email" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Tạo mật khẩu*</label>
                        <input type="password" name="password" required class="form-control mb-2" placeholder="Tạo mật khẩu">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label>Vai trò</label>
                        <select name="role" class="form-control mb-2">
                            @foreach(UserRole::options() as $key => $role)
                                <option value="{{ $key }}" {{ old('role', $user->role ?? '') == $key ? 'selected' : '' }}>
                                    {{ $role }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Thông tin cá nhân -->
    <div class="card">
        <div class="card-body">
            <h4 class="mt-0 mb-3 header-title" style="color:#2d91e1">Thông tin cá nhân</h4>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Họ & Tên*</label>
                        <input type="text" required name="name" value="{{ old('name', $user->name ?? '') }}" class="form-control mb-2" placeholder="Name">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Tình trạng hôn nhân</label>
                        <select name="department_id" class="form-control mb-2">
                            @foreach(MaritalStatus::options() as $key => $status)
                                <option value="{{ $key }}" {{ old('marital_status', $user->profile->marital_status ?? '') == $key ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Ngày vào làm</label>
                        <input type="date" name="start_date" value="{{ old('start_date', $user->profile->start_date ?? '') }}" class="form-control mb-2" placeholder="Name">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Giới tính</label>
                        <select name="gender" class="form-control mb-2">
                            @foreach(Gender::options() as $key => $status)
                                <option value="{{ $key }}" {{ old('gender', $user->profile->gender ?? '') == $key ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Ngày sinh</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $user->profile->date_of_birth ?? '') }}" class="form-control mb-2" placeholder="Name">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="text" name="Số điện thoại" value="{{ old('phone', $user->profile->phone ?? '') }}" class="form-control mb-2" placeholder="Số điện thoại">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Phòng ban</label>
                        <select name="department_id" class="form-control mb-2">
                            <option value="">Please select</option>
                            @foreach($departments as $dep)
                                <option value="{{ $dep->id }}" {{ old('department_id', $user->profile->department_id ?? '') == $dep->id ? 'selected' : '' }}>
                                    {{ $dep->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Số CCCD</label>
                        <input type="text" name="cccd" value="{{ old('cccd', $user->profile->cccd ?? '') }}" class="form-control mb-2" placeholder="Số CCCD">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Ngày cấp CCCD</label>
                        <input type="date" name="cccd_date" value="{{ old('cccd_date', $user->profile->cccd_date ?? '') }}" class="form-control mb-2" placeholder="Name">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Chức vụ</label>
                        <input type="text" name="position" value="{{ old('name', $user->profile->position ?? '') }}" class="form-control mb-2" placeholder="Chức vụ">
                    </div>
                </div>
                <div class="form-group col-lg-8">
                    <label>Địa chỉ</label>
                    <textarea name="address" class="form-control mb-3">{{ old('address', $user->profile->address ?? '') }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-primary">Lưu thông tin</button>
</form>
@section('scripts')
    <script>
        function confirmSubmit() {
            return confirm('Bạn có muốn lưu thông tin vừa nhập không?');
        }
    </script>
@endsection
