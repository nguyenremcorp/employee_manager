@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<div class="wrapper-page">
    <div class="card card-pages shadow-none">
        <div class="card-body">
            <h1 class="font-18 text-center">Sign in</h1>
            <form class="form-horizontal m-t-30" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="col-12">
                        <label>Email</label>
                        <input class="form-control @error('email') is-invalid @enderror" name="email" type="text" value="{{ old('email') }}" placeholder="Email">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12">
                        <label>Password</label>
                        <input class="form-control @error('password') is-invalid @enderror" name="password" type="password" placeholder="Password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-12">
                        <button class="btn btn-primary btn-block btn-lg waves-effect waves-light" type="submit">Log In</button>
                    </div>
                </div>
                <div class="form-group ml-20 mr-20">
                @if ($errors->has('login_error'))
                    <div class="alert alert-danger">
                        {{ $errors->first('login_error') }}
                    </div>
                @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
