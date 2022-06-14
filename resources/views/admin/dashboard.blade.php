@extends('admin.layouts.main')

@section('main-content')
    <div class="container p-3">
        <span class="fs-4 fw-bold">Dashboard</span>
        <hr>

        <div class="row p-3 mt-2 gap-4">
            <div class="col border rounded" style="background-color: #7AF1D8;">
                <ul class="nav flex-column mb-auto">
                    <li>
                        <a href="/admin/daftarSeller" class="nav-link text-black fs-5">
                            <p class="fw-bold fs-4">Daftar Seller</p>
                            <hr>
                            <p class="fs-5">{{ $sellers->count() }} seller aktif</p>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col border rounded" style="background-color: #7AA3F1;">
                <ul class="nav flex-column mb-auto">
                    <li>
                        <a href="/admin/daftarBuyer" class="nav-link text-black fs-5">
                            <p class="fw-bold fs-4">Daftar Buyer</p>
                            <hr>
                            <p class="fs-5">{{ $buyers->count() }} buyer aktif</p>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col border rounded" style="background-color: #82fff5;">
                <ul class="nav flex-column mb-auto">
                    <li>
                        <div class="nav-link text-black fs-5">
                            <p class="fw-bold fs-4">Banyak Property</p>
                            <hr>
                            <p class="fs-5">{{ $properties->count() }} Property</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col border rounded" style="background-color: #ACE98D;">
                <ul class="nav flex-column mb-auto">
                    <li>
                        <a href="/admin/requestUpgrade" class="nav-link text-black fs-5">
                            <p class="fw-bold fs-4">Request Jadi Seller</p>
                            <hr>
                            <p class="fs-5">{{ $requests->count() }} permintaan menjadi seller</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
