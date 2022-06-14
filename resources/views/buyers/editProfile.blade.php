@extends('layouts.main')

<!-- header section -->
@include('partials.navbar2')

<!-- container section -->
<div class="container mt-5">
    <form method="post" action="/dashboard/{{ auth()->user()->username }}" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div style="padding-left: 10rem; padding-right: 10rem;">
            <h1 class="text-center fs-1 mb-3">Edit Profile</h1>
            <div class="rounded p-4" style="background-color: #E7F9FD;">
                <div class="form-group mb-3">
                    <label for="front-name" class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', $buyer->user->name) }}" required">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="phone" class="form-label">No. Telepon</label>
                    <input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" value="{{ old('phone', $buyer->phone) }}" required>
                    @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email', $buyer->user->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" value="{{ old('username', $buyer->user->username) }}" required>
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="image" class="form-label">Photo Profile</label>
                    <input type="hidden" name="old_photo_profile" value="{{ $buyer->photo_profile }}">
                    @if ($buyer->photo_profile)
                        <img class="img-preview img-thumbnail mb-3 col-sm-2 d-block rounded-circle" width="100" height="100" src="{{ asset('storage/' . $buyer->photo_profile) }}">
                    @else
                        <img class="img-preview img-thumbnail mb-3 col-sm-2 rounded-circle" width="100" height="100">
                    @endif
                    <input class="form-control @error('photo_profile') is-invalid @enderror" type="file" id="image" name="photo_profile" onchange="previewImage()">
                    @error('photo_profile')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary px-5 py-2 position-relative bottom-0 start-50 translate-middle-x">Update Profile</button>
            </div>
        </div>
    </form>
</div>
<br>

<!-- footer section  -->
@include('partials.footer2')
