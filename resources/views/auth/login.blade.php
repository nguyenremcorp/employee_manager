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
                        <input class="form-control" name="email" type="text" required="" value="{{ old('email') }}" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12">
                            <label>Password</label>
                        <input class="form-control" name="password" type="password" required="" placeholder="Password">
                    </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-12">
                        <button class="btn btn-primary btn-block btn-lg waves-effect waves-light" type="submit">Log In</button>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="form-group">
                        <div class="col-12" style="color: red;">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
