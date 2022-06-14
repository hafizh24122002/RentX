@extends('admin.layouts.main')

@section('main-content')
    <div class="container p-3">
        <span class="fs-4 fw-bold">Daftar Admin</span>
        <hr>
        <div class="border border-secondary rounded" style="overflow-y: auto; height: 80vh; overflow-x: auto;">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr style="background-color: #BFBFBF;">
                            <th class="col">No</th>
                            <th class="col">Nama</th>
                            <th class="col">Usia</th>
                            <th class="col">Alamat</th>
                            <th class="col">Posisi</th>
                            <th class="col">Username</th>
                            <th class="col">Username</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Farhan Dwian Saputra</td>
                            <td>21</td>
                            <td>Jl. Bandung no 123 Bandung barar </td>
                            <td>Admin Transaksi</td>
                            <td>farhandwian69</td>
                            <td>farhandwian69</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
