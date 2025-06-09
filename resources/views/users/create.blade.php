@extends('layouts.app')

@section('title', 'Dashboard')

@section('pageTitle' , 'Đăng ký người dùng mới')

@section('content')
<div class="pt-2">
    @include('users.partials.user_form')
</div>
@endsection
