@extends('layouts.app')

@section('title', 'Dashboard')

@section('pageTitle', 'Cập nhật thông tin ')

@section('content')
<div class="pt-2">
    @include('users.partials.user_form')
</div>
@endsection
