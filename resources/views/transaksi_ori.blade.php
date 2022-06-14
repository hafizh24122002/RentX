@extends('admin.layouts.main')

@section('main-content')
@php
$i = 1
@endphp
<div class="container p-3">
    <span class="fs-4 fw-bold">Daftar Transaksi</span>
    <hr>
    <div class="border border-secondary rounded" style="overflow-y: auto; height: 80vh; overflow-x: auto;">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr style="background-color: #BFBFBF;">
                        <th class="col">No</th>
                        <th class="col">Nama Buyer</th>
                        <th class="col">Properti</th>
                        <th class="col">Tanggal Pemesanan</th>
                        <th class="col">Tanggal Masuk</th>
                        <th class="col">Tanggal Keluar</th>
                        <th class="col">Durasi</th>
                        <th class="col">Total Pembayaran</th>
                        <th class="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$order->buyer_id}}</td>
                        <td>{{$order->properti_id}}</td>
                        <td>{{$order->date_order}}</td>
                        <td>{{$order->check_in}}</td>
                        <td>{{$order->check_out}}</td>
                        <td>{{$order->duration}}</td>
                        <td>{{$order->total_payment}}</td>
                        <td>
                            <select class="form-control" name="confirmation" id="confirmation">
                                <option value="pending" data-toggle="modal" data-target="#exampleModal" selected>Pending
                                </option>
                                <option value="accepted">Diterima</option>
                                <option value="rejected">Ditolak</option>
                            </select>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script>
    let oldConfirmationStatus;
        $('#confirmation').change(function() {
            let newConfirmationStatus = $(this).val();
            if(!confirm("Apakah anda yakin ingin mengubah status transaksi ini?")) {
                $(this).val(oldConfirmationStatus);
                return;
            }
            oldConfirmationStatus = newConfirmationStatus;
        });
</script>
@endsection