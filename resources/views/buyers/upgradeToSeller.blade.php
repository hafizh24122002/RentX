@extends('buyers.layouts.main')

@section('main-content')
    <div class="row">
        <!-- left side section -->
        @include('buyers.layouts.sidebar')

        <!-- right side section -->
        <div class="col p-3">
            <h1 class="fs-3 fw-bold mb-3">{{ $optionName }}</h1>
            <div class="border border-secondary rounded px-4 py-3" style="overflow-y: auto; height: 61vh">
               <form action="/dashboard/become-seller" method="post" enctype="multipart/form-data">
                @csrf
                    <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="phone" id="phone" value="{{ $buyer->phone }}">
                    <div class="row">
                        <div class="form-group mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" id="nik" required">
                            @error('nik')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" rows="4" required></textarea>
                            @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="photo_ktp" class="form-label">Foto KTP</label>
                                <input type="file" name="photo_ktp" class="form-control @error('photo_ktp') is-invalid @enderror" id="photo_ktp" required>
                                @error('photo_ktp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                        <div class="form-group mb-3">
                                <label for="photo_selfie" class="form-label">Foto Selfie</label>
                                <input type="file" name="photo_selfie" class="form-control @error('photo_selfie') is-invalid @enderror" id="photo_selfie" required>
                                @error('photo_selfie')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary px-5 py-2">Kirim</button>
               </form>
            </div>
        </div>
    </div>
@endsection

