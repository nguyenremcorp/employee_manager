<div id="list-user-table" class="text-center pb-2 pt-2">
    @if($users->isEmpty())
        <p>Empty data.</p>
    @else
        <table class="table table-bordered">
            <thead class="thead-default">
                <tr>
                    <th>STT</th>
                    <th>Họ Tên</th>
                    <th>Năm sinh</th>
                    <th>Giới tính</th>
                    <th>Email</th>
                    <th>Vai trò</th>
                    <th>Số điện thoại</th>
                    <th>Phòng ban</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $key => $user)
                <tr>
                    <td>{{ $key += 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($user->profile->date_of_birth)->year }}</td>
                    <td>{{ \App\Enum\Gender::label($user->profile->gender) }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ \App\Enum\UserRole::label($user->role)}}</td>
                    <td>{{ $user->profile->phone ?? '' }}</td>
                    <td>{{ $user->profile->department->name ?? '' }}</td>
                    <td class="text-center w-1">
                        <a href="{{ route('user.show',  $user) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE') 
                            <button type="submit" onclick="return confirm('Are you sure you want to delete {{ $user->name }}?');" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @include( 'common.pagination')
    @endif
</div>