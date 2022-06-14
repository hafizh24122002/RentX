@extends('buyers.layouts.main')

@section('main-content')
<div class="row">
    <!-- left side section -->
    @include('buyers.layouts.sidebar')

    <!-- right side section -->
    <div class="col p-3">
        <h1 class="fs-3 fw-bold mb-3">Riwayat Kos</h1>
        <div class="border border-secondary rounded px-4 py-3" style="overflow-y: auto; height: 61vh">
            @foreach ($orders as $order)
            <div class="row border border-secondary rounded p-3 mb-3">
                <div class="col">
                    <div class="row">
                        <p class="fw-bold mb-0">{{ $order->property->title }}</p>
                        <p class="">{{ $order->property->address }}</p>
                    </div>
                    <div class="row mt-2">
                        <p class="mb-0">{{ $order->property->price }}</p>
                    </div>
                </div>
                <div class="col-4 d-flex align-items-end flex-column">
                    <div class="row">
                        <p class="">Durasi: {{ $order->duration }} Bulan</p>
                    </div>
                    <div class="row invisible">
                        <p>Invisible</p>
                    </div>
                    <div class="row">
                        @if ($order->status == "paid")
                        <a class="btn btn-success mb-0" href="/buyers/review/dashboard/{{ $order->id }}">Review</a>
                        @elseif($order->status == "reviewed")
                        <button class="btn btn-success mb-0" data-bs-target="#lihatReview{{$order->id}}"
                            data-bs-toggle="modal">Lihat
                            Review</button>
                        @endif
                    </div>
                </div>
            </div>

            {{-- <button class="dropdown-item btn-detail" data-target="#detailBiblio{{ $item->id }}"
                data-toggle="modal">Detail</button> --}}
            {{-- Modal lihat Review --}}
            @if ($order->review)
            <div class="modal fade" id="lihatReview{{$order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content  mt-5">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Review {{$order->review->comment}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        {{-- <div class="modal-body">
                            <div class="card mb-3">
                                <div class="row g-0">
                                    <div class="card-body">
                                        {{$order->review->comment}}
                                    </div>
                                </div>
                                <div class="row g-0">
                                    <div class="card-body">
                                        {{$order->review->rating}}
                                    </div>
                                </div>
                            </div>

                        </div> --}}
                        <div class="modal-body">
                            <div class="comment border rounded p-3" style="background-color: #E7F9FD;">
                                <form action="/buyers/review/{{$order->review->id}}" method="post">
                                    @method('put')
                                    @csrf
                                    <div class="login-bg">
                                        <label for="comment" class="form-label">Komentar</label>
                                        <textarea class="form-control" name="comment" id="comment"
                                            placeholder="Tulis komentar anda">{{$order->review->comment}}</textarea>
                                        <br>
                                        <label for="rating" class="form-label">Rating</label>
                                        <select name="rating" id="star-rating">
                                            <option value="5" {{ $order->review->rating == '5' ? 'selected' : '' }}>5
                                            </option>
                                            <option value="4" {{ $order->review->rating == '4' ? 'selected' : '' }}>4
                                            </option>
                                            <option value="3" {{ $order->review->rating == '3' ? 'selected' : '' }}>3
                                            </option>
                                            <option value="2" {{ $order->review->rating == '2' ? 'selected' : '' }}>2
                                            </option>
                                            <option value="1" {{ $order->review->rating == '1' ? 'selected' : '' }}>1
                                            </option>
                                        </select>
                                        <br>
                                        <button type='submit' class="btn btn-primary mt-2">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div> --}}
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>
@endsection