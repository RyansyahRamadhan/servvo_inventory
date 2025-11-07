@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Akun Baru</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group mt-3">
            <label for="username">Username</label>
            <input id="username" type="text" name="username" value="{{ old('username') }}" required class="form-control">
        </div>

        <div class="form-group mt-3">
            <label for="role">Role (contoh: administrator / user)</label>
            <input id="role" type="text" name="role" value="{{ old('role') }}" required class="form-control">
        </div>

        <div class="form-group mt-3">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required class="form-control">
        </div>

        <div class="form-group mt-3">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required class="form-control">
        </div>

        <button type="submit" class="btn btn-success mt-3">Daftar</button>
    </form>
</div>
@endsection
