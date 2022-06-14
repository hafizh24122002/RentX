@extends('buyers.layouts.main')

@section('main-content')
    <div class="row mb-5 gap-3">
        <h2>Halaman Pembayaran</h2>
        <!-- left side  -->
        <div class="col border border-secondary rounded p-3" style="background-color: #E7F9FD;">
            <p class="fw-bold">No Order : <span class="fw-normal">123456789</span></p>
            <hr>
            <div class="row">
                <p class="fw-bold fs-4">{{ $order->property->title }}</p>
                <p class="fs-5">{{ $order->property->address }}</p>
            </div>
            <div class="row">
                <div class="col">
                    <hr>
                    <p>Mulai Sewa : </p>
                    <h6>{{ \Carbon\Carbon::parse($order->check_in)->toFormattedDateString() }}</h6>
                    <hr>
                </div>
                <div class="col">
                    <hr>
                    <p>Akhir Sewa : </p>
                    <h6>{{ \Carbon\Carbon::parse($order->check_out)->toFormattedDateString() }}</h6>
                    <hr>
                </div>
                <div class="col">
                    <hr>
                    <p>Durasi Sewa : </p>
                    <h6>{{ $order->duration }} Bulan</h6>
                    <hr>
                </div>
            </div>
            <div class="row">
                <h5>Metode Pembayaran :</h5>
                <div class="col-md">
                    <img class="rounded" src="/img/bayarlogo_bri.png" alt="Logo BRI" height="25">
                </div>
                <div class="col-md">
                    <img class="rounded" src="/img/bayarlogo_bca.png" alt="Logo BCA" height="25">
                </div>
                <div class="col-md">
                    <img class="rounded" src="/img/bayarlogo_bni.png" alt="Logo BNI" height="25">
                </div>
                <div class="col-md">
                    <img class="rounded" src="/img/bayarlogo_mandiri.png" alt="Logo Mandiri" height="25">
                </div>
            </div>
        </div>
        <!-- right side -->
        <div class="col-4 border border-secondary rounded p-3" style="background-color: #E7F9FD; height: 30%;">
            <div class="row">
                <div class="col">
                    <p class="fw-bold fs-5">Total Pembayaran :</p>
                </div>
                <div class="col">
                    <p class="fs-5"><x-money amount="{{ $order->total_payment }}" currency="IDR" convert/></p>
                </div>
            </div>
            <form action="/payment/{{ $order->id }}" method="POST">
                @method('put')
                @csrf
                <input type="hidden" name="status" value="paid">
                <button class="btn btn-success" type="submit" style="width: 100%;">Bayar</button>
            </form>
        </div>
    </div>
@endsection
