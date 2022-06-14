@extends('admin.layouts.main')

@section('main-content')
    <div class="container p-3">
        <span class="fs-4 fw-bold">Daftar Seller</span>
        <hr>
        <div class="border border-secondary rounded" style="overflow-y: auto; height: 80vh; overflow-x: auto;">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr style="background-color: #BFBFBF;">
                            <th class="col">No</th>
                            <th class="col">Nama</th>
                            <th class="col">Username</th>
                            <th class="col">Email</th>
                            <th class="col">No. Telepon</th>
                            <th class="col">Alamat</th>
                            <th class="col">No. KTP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sellers as $seller)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $seller->user->name }}</td>
                                <td>{{ $seller->user->username }}</td>
                                <td>{{ $seller->user->email }}</td>
                                <td>{{ $seller->phone }}</td>
                                <td>{{ $seller->address }}</td>
                                <td>{{ $seller->nik }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
