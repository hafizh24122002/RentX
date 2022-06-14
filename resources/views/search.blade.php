@extends('layouts.main')

@section('main-content')
<!-- navbar section -->
@include('partials.navbar2')

<div class="container mt-5">
    <div class="">
        <form action="/search" class="gap-4">
            <div class="form-inline">
                <input class="form-control mb-2 mr-sm-2" id="search-input" name="search" placeholder="Cari kos yang anda inginkan" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary mb-2">Cari</button>
            </div>
            <div class="form-inline">
                <ul class="list-group list-group-horizontal gap-2" style="list-style: none; border: none;">
                    <li>
                        <select class="btn btn-primary form-select px-5 text-start" name="sort">
                            <option {{ request('sort') == '' ? 'selected' : 'disable' }} value="">Urut Berdasarkan</option>
                            <option {{ request('sort') == 'recommend' ? 'selected' : '' }} value="recommend">Rekomendasi</option>
                            <option {{ request('sort') == 'highest-price' ? 'selected' : '' }} value="highest-price">Harga Tertinggi</option>
                            <option {{ request('sort') == 'lowest-price' ? 'selected' : '' }} value="lowest-price">Harga Terendah</option>
                        </select>
                    </li>
                    <li>
                        <select class="btn btn-primary form-select px-5 text-start" name="type">
                            <option {{ request('type') == '' ? 'selected' : 'disable' }} value="">Tipe Properti</option>
                            <option {{ request('type') == 'kosan' ? 'selected' : '' }} value="kosan">Kosan</option>
                            <option {{ request('type') == 'kontrakan' ? 'selected' : '' }} value="kontrakan">Kontrakan</option>
                        </select>
                    </li>
                    <li>
                        <select class="btn btn-primary form-select px-5 text-start" name="for">
                            <option {{ request('for') == '' ? 'selected' : 'disable' }} value="">Disewakan Untuk</option>
                            <option {{ request('for') == 'putra' ? 'selected' : '' }} value="putra">Putra</option>
                            <option {{ request('for') == 'putri' ? 'selected' : '' }} value="putri">Putri</option>
                            <option {{ request('for') == 'campur' ? 'selected' : '' }} value="campur">Campur</option>
                        </select>
                    </li>
                </ul>
            </div>
        </form>
    </div>

    <div class="container mt-3">
        @foreach ($properties as $property)
        <a href="/property/{{ $property->slug }}" class="text-black" style="text-decoration: none;">
            <div class="card card-browse">
                <div class="row">
                    <div class="col">
                        <img src="{{ asset('storage/' . $property->photo_1) }}" class="card-img-browse" height="208" width="300">
                    </div>
                    <div class="col">
                        <div class="card-body">
                            <div class="card-content">
                                <div class="card-content-star">
                                    <i class="fa-regular fa-star"></i>
                                    <h6 class="card-text browse-rating-text">{{ $property->rating }}</h6>
                                </div>
                                <div class="card-content-detail">
                                    <p class="card-text card-content-detail-name">{{ $property->title }}</p>
                                    <p class="card-text card-content-detail-location">{{ $property->district }} - {{ $property->city }} - {{ $property->province }}</p>
                                </div>
                                <div class="card-content-detail">
                                    <p class="card-text card-content-detail-name">
                                        <x-money amount="{{ $property->price }}" currency="IDR" convert /> / bulan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>


    <div class="d-flex mt-4 justify-content-end">
        {{ $properties->links() }}
    </div>
</div>

@endsection
