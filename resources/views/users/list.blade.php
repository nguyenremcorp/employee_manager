@extends('layouts.app')

@section('title', 'Dashboard')

@section('pageTitle' , 'Danh sách nhân viên')

@section('content')
<div class="pt-2">
    <div class="card">
        <div class="card-body">
            <h5 style="color: #2d91e1"></h5>
            <!-- Form search, filter -->
            @include('users.partials.search_form')
            <!-- Danh sách user  -->
            @include('users.partials.user_table')
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $('#select_deparment, #marital_status, #gender').on('change', function () {
            $('#search-form').submit();
        });
    </script>
@endsection
