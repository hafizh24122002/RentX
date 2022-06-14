@extends('admin.layouts.main')

@section('main-content')
    <div class="container p-3">
        <span class="fs-4 fw-bold">Daftar Buyer</span>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($buyers as $buyer)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $buyer->user->name }}</td>
                                <td>{{ $buyer->user->username }}</td>
                                <td>{{ $buyer->user->email }}</td>
                                <td>{{ $buyer->phone }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
