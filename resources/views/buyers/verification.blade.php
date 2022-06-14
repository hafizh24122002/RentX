@extends('buyers.layouts.main')

@section('main-content')
    <div class="row">
        <!-- left side section -->
        @include('buyers.layouts.sidebar')

        <!-- right side section -->
        <div class="col p-3">
        <h1 class="fs-3 fw-bold mb-3">Verifikasi Akun</h1>
        <div class="border border-secondary rounded px-4 py-3" style="overflow-y: auto; height: 61vh">
            <form action="">
                <div class="">
                    <label for="inputGroupFile04" class="fw-bold">Masukan Foto KTP</label>
                </div>
                <div class="input-group">
                    <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection