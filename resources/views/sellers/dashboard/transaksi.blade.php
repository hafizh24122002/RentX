@extends('sellers.layouts.main')

@section('container')
<div class="row">
    <!-- left side section -->
    @include('sellers.layouts.sidebar')

    <!-- right side section -->
    <div class="col p-3">
        <div class="row">
            <h1 class="fs-3 fw-bold mb-3">{{ $optionName }}</h1>
        </div>
        <div class="border border-secondary rounded px-4 py-3" style="overflow-y: auto; height: 61vh">
            @foreach ($orders as $order)
                <div class="row border border-secondary rounded p-3 mb-3">
                    <p>{{$order->date_order}}</p>
                    <hr>
                    <div class="col">
                        <div class="row">
                            <p class="fw-bold mb-0">{{ $order->property->title }}</p>
                            <p class="">{{ $order->property->address }}</p>
                        </div>
                        <div class="row"><p class="mb-0">Pemesan: {{$order->buyer->user->name}}</p></div>
                    </div>
                    <div class="col text-end">
                        <div class="row">
                            <p class="fw-bold mb-0">Durasi: {{$order->duration}} bulan</p>
                            <p class="">{{$order->check_in}} - {{$order->check_out}}</p>
                        </div>
                        <div class="row">
                            <p class="">Total Payment: <x-money amount="{{ $order->total_payment }}" currency="IDR" convert/></p>
                            <form action="/seller/dashboard/orders/{{ $order->id }}" method="post">
                                @csrf
                                <button class="btn btn-info" type="submit" name="status" value="accepted">Diterima</button>
                                <button class="btn btn-danger" type="submit" name="status" value="rejected">Ditolak</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

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
