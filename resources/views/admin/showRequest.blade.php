@extends('admin.layouts.main')

@section('main-content')
<div class="container p-3">
    <span class="fs-4 fw-bold">Request Jadi Seller</span>
    <hr>
    <div class="p-3">
        <div class="row">
            <div class="col-md mb-1">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" value="{{ $requester->user->name }}" disabled>
            </div>
            <div class="col-md-3 mb-1">
                <label for="nik" class="form-label">NIK</label>
                <input type="number" class="form-control" id="nik" value="{{ $requester->nik }}" disabled>
            </div>
            <div class="col-md-3 mb-1">
                <label for="phone" class="form-label">Phone</label>
                <input type="number" class="form-control" id="phone" value="{{ $requester->phone }}" disabled>
            </div>
        </div>
        <div class="row">
            <div class="mb-1">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" rows="2" disabled>{{ $requester->address }}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="photo_selfie" class="form-label">Foto Selfie</label><br>
                <img src="{{ asset('storage/' . $requester->photo_selfie) }}" alt="Foto Selfie" height="200">
            </div>
            <div class="col">
                <label for="photo_selfie" class="form-label">Foto KTP</label><br>
                <img src="{{ asset('storage/' . $requester->photo_ktp) }}" alt="Foto KTP" height="200">
            </div>
            <div class="col"></div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-1">
                <form action="/admin/requestUpgrade/{{ $requester->user->username }}" method="post">
                    @method('put')
                    @csrf
                    <input type="hidden" name="status" value="accepted">
                    <button class="btn btn-info" type="submit">Diterima</button>
                </form>
            </div>
            <div class="col-md">
                <form action="/admin/requestUpgrade/{{ $requester->user->username }}" method="post">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger" type="submit">Ditolak</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script>
    let oldConfirmationStatus;
        $('#status').change(function() {
            let newConfirmationStatus = $(this).val();
            if(!confirm("Apakah anda yakin ingin mengubah status transaksi ini?")) {
                $(this).val(oldConfirmationStatus);
                return;
            }
            oldConfirmationStatus = newConfirmationStatus;
        });
</script>
@endsection
