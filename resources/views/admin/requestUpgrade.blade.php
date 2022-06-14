@extends('admin.layouts.main')

@section('main-content')
@php
$i = 1
@endphp
<div class="container p-3">
    <span class="fs-4 fw-bold">Request Jadi Seller</span>
    <hr>
    <div class="border border-secondary rounded" style="overflow-y: auto; height: 80vh; overflow-x: auto;">
        @if ($requests)
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr style="background-color: #BFBFBF;">
                        <th class="col">No</th>
                        <th class="col">Nama Seller</th>
                        <th class="col">Username</th>
                        <th class="col">Email</th>
                        <th class="col">Status</th>
                        <th class="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requests as $request)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $request->user->name }}</td>
                        <td>{{ $request->user->username }}</td>
                        <td>{{ $request->user->email }}</td>
                        <td>{{ $request->status }}</td>
                        <td><a class="btn btn-warning" href="/admin/requestUpgrade/{{ $request->user->username }}">Detail</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
            <p class="text-center my-3 fs-5">No request found.</p>
        @endif
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
