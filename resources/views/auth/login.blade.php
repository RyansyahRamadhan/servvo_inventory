@extends('layouts.app-login')

@section('content')
<div class="login-container">
    <div class="login-box">
        <h4 class="login-title">Login</h4>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <input type="text" name="username" placeholder="ID" class="form-control" required autofocus>
            </div>

            <div class="mb-3">
                <input type="password" name="password" placeholder="Password" class="form-control" required>
            </div>

            
            <div class="d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
</div>
@endsection
