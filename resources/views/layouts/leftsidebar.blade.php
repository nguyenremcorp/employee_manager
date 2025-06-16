<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">
        <div id="sidebar-menu">
            @auth
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Menu</li>
                <li>
                    <a href="{{ route('welcome') }}" class="waves-effect">
                        <i class="icon-paper-sheet"></i><span>Trang chủ</span>
                    </a>
                </li>
                @if (auth()->user()->isAdmin)
                <li>
                    <a href="{{ route('user.show', Auth::user()) }}" class="waves-effect">
                        <i class="icon-paper-sheet"></i><span>Thông tin cá nhân</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('users.create') }}" class="waves-effect">
                        <i class="icon-paper-sheet"></i><span>Thêm nhân viên</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.list') }}" class="waves-effect">
                        <i class="icon-paper-sheet"></i><span>Danh sách nhân viên</span>
                    </a>
                </li>
                @else
                <li>
                    <a href="{{ route('user.show', Auth::user()) }}" class="waves-effect">
                        <i class="icon-paper-sheet"></i><span>Thông tin cá nhân</span>
                    </a>
                </li>
                @endif
            </ul>
            @endauth
        </div>
        <div class="clearfix"></div>
    </div>
</div>