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
                        <div class="col">
                            <div class="row">
                                <p class="fw-bold mb-0">{{ $order->property->title }}</p>
                                <p class="">{{ $order->property->address }}</p>
                            </div>
                        </div>
                        <div class="col-4 d-flex align-items-end flex-column">
                            <div class="row invisible">Invisible</div>
                            <div class="row invisible">Invisible</div>
                            <div class="row">
                                <a href="#"><button class="btn btn-danger mb-0">Hapus</button></a>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="row border border-secondary rounded p-3 mb-3">
                    <div class="col">
                        <div class="row">
                            <p class="fw-bold mb-0">{{ $propertyName }}</p>
                            <p class="">{{ $propertyAddress }}</p>
                        </div>
                    </div>
                    <div class="col-4 d-flex align-items-end flex-column">
                        <div class="row invisible">Invisible</div>
                        <div class="row invisible">Invisible</div>
                        <div class="row">
                            <a href="#"><button class="btn btn-danger mb-0">Hapus</button></a>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
