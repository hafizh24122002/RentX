@extends('layouts.main')

@section('main-content')
<!-- navbar section -->
@include('partials.navbar2')

<div class="container mt-5">
  <div class="landing-page-search">
    <h4>Cari Kos / Kontrakan</h4>

    <form action="/search" class="form-inline">
      <input class="form-control mb-2 mr-sm-2" id="search-input" name="search"
        placeholder="Cari kos yang anda inginkan" value="{{ request('search') }}" required>
      <button type="submit" class="btn btn-primary mb-2">Cari</button>
    </form>
  </div>

  <div class="landing-page-recommendation">
    <h2 class="mt-4 mb-3">Rekomendasi Kos / Kontrakan</h2>

    <!-- Slider main container -->
    <div class="swiper">
      <!-- Additional required wrapper -->
      <div class="swiper-wrapper">
        <!-- Slides -->
        {{-- slide 1 --}}
        <div class="swiper-slide">
          @foreach ($properties->take(5) as $property)
          <a href="/property/{{ $property->slug }}" class="text-black" style="text-decoration: none;">
            <div class="card">
                <img src="{{ asset('storage/' . $property->photo_1) }}" class="card-img-top" alt="House" height="170">
                <div class="card-body">
                    <p class="card-text">{{ $property->title }}</p>
                    <span class="fa fa-star star-checked">{{$property->rating}}</span>
                </div>
            </div>
        </a>
          @endforeach
        </div>

        {{-- slide 2 --}}
        <div class="swiper-slide">
          @foreach ($properties->skip(5) as $property)
          <a href="/property/{{ $property->slug }}" class="text-black" style="text-decoration: none;">
            <div class="card">
                <img src="{{ asset('storage/' . $property->photo_1) }}" class="card-img-top" alt="House" height="170">
                <div class="card-body">
                    <p class="card-text">{{ $property->title }}</p>
                    <span class="fa fa-star star-checked">{{$property->rating}}</span>
                </div>
            </div>
        </a>
          @endforeach
        </div>

        {{-- slide 3 --}}
        {{-- <div class="swiper-slide">Slide 3</div> --}}
      </div>
      <!-- If we need pagination -->
      <div class="swiper-pagination"></div>

      <!-- If we need navigation buttons -->
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </div>
  </div>

  <br />

  <div class="row">
    <h2 class="mt-2 mb-2">Area Kos / Kontrakan Populer</h2>
    <div class="col-md">
      <a href="/search?city=bandung" class="text-black" style="text-decoration: none;">
        <img src="/img/bandung.jpg" alt="Bandung" class="rounded w-100" height="200">
        <p class="text-center fw-bold fs-4">Bandung</p>
      </a>
    </div>
    <div class="col-md">
      <a href="/search?city=jakarta" class="text-black" style="text-decoration: none;">
        <img src="/img/jakarta.jpg" alt="Jakarta" class="rounded w-100" height="200">
        <p class="text-center fw-bold fs-4">Jakarta</p>
      </a>
    </div>
    <div class="col-md">
      <a href="/search?city=semarang" class="text-black" style="text-decoration: none;">
        <img src="/img/semarang.jpg" alt="Semarang" class="rounded w-100" height="200">
        <p class="text-center fw-bold fs-4">Semarang</p>
      </a>
    </div>
    <div class="col-md">
      <a href="/search?city=surabaya" class="text-black" style="text-decoration: none;">
        <img src="/img/surabaya.jpg" alt="Surabaya" class="rounded w-100" height="200">
        <p class="text-center fw-bold fs-4">Surabaya</p>
      </a>
    </div>
  </div>
</div>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="{{ asset('js/swiper.js') }}"></script>

<!-- footer section  -->
@include('partials.footer2')
@endsection

