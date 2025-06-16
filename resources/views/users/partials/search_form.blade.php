@php
$maritalOptions = get_options('marital');
$genderOptions = get_options('gender');
@endphp

<!-- Search form -->
<form id="search-form" method="GET" action="{{ route('admin.list') }}">
    <div class="row">
        <div class="col-lg-8">
            <div class="pb-2"><label>Tìm kiếm theo: </label></div>
            <!-- Hardcode -->
            @foreach(['name' => 'Tên', 'email' => 'Email', 'phone' => 'Số điện thoại'] as $key => $value)
            <label><input type="radio" name="search_by" value="{{ $key }}" {{ request('search_by') == $key ? 'checked' : '' }}> &nbsp;{{ $value }}&nbsp;</label>&nbsp;&nbsp;
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control mb-2" placeholder="Nhập từ khoá tìm kiếm (Tên, email, phone)">
        </div>
        <div class="col-lg-2">
            <button type="submit" id="btn_search" class="btn btn-primary mb-3">Tìm kiếm</button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2">
            <div class="form-group">
                <label>Phòng ban</label>
                <select name="department" id="select_deparment" class="form-control mb-2 @error('department') is-invalid @enderror">
                    <option value="">Select option</option>
                    @foreach($departments as $dep)
                    <option value="{{ $dep->id }}" {{ request('department') == $dep->id ? 'selected' : '' }}>
                        {{ $dep->name }}
                    </option>
                    @endforeach
                </select>
                @error('department')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <!-- Tình trạng hôn nhân -->
        <div class="col-lg-2">
            <div class="form-group">
                <label>Tình trạng hôn nhân</label>
                <select name="marital_status" id="marital_status" class="form-control mb-2 @error('marital_status') is-invalid @enderror">
                    <option value="">Select option</option>
                    @foreach($maritalOptions as $key => $status)
                    <option value="{{ $key }}" value="{{ $key }}" {{ request('marital_status') == $key ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                    @endforeach
                </select>
                @error('marital_status')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <!-- Giới tính -->
        <div class="col-lg-2">
            <div class="form-group">
                <label>Giới tính</label>
                <select name="gender" id="gender" class="form-control mb-2 @error('gender') is-invalid @enderror">
                    <option value="">Select option</option>
                    @foreach($genderOptions as $key => $gender)
                    <option value="{{ $key }}" value="{{ $key }}" {{ request('gender') == $key ? 'selected' : '' }}>
                        {{ $gender }}
                    </option>
                    @endforeach
                </select>
                @error('gender')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</form>