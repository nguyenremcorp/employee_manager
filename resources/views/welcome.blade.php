@extends('layouts.app')

@section('title', 'Employee Manager')

@section('pageTitle' , 'Trang chủ')

@section('content')


<div class="p-2 text-center">
    @auth
        <img src="{{ auth()->user()->isAdmin ? asset('assets/images/admin_welcome.png') : asset('assets/images/user_welcome.png') }}" style="width:60%" alt="Company image welcom">
    @endauth
</div>
@endsection
