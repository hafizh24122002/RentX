@extends('layouts.main')

<!-- navbar section -->
@include('partials.navbarAdmin')

<!-- container section -->
<div class="container" style="padding-left: 10rem; padding-right: 10rem;">
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if (session()->has('loginError'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('loginError') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <form action="/login" method="POST">
        @csrf
        <h1 class="text-center fs-1 mb-3">RentX - Login Admin</h1>
        <div class="rounded p-4" style="background-color: #E7F9FD;">
            <div class="form-group mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Masukkan username anda" required value="{{ old('username') }}" autofocus>
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password anda" required>
                <input type="checkbox" onclick="showPass()"> Show Password
            </div>
            <button type="submit" class="btn btn-primary px-5 py-2 position-relative bottom-0 start-50 translate-middle-x">Login</button>
        </div>
    </form>
</div>

<!-- footer section  -->
@include('partials.footer')
