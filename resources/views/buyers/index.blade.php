@extends('buyers.layouts.main')

@section('main-content')

<div class="row">
    <!-- left side section -->
    @include('buyers.layouts.sidebar')

    <!-- right side section -->
    <div class="col p-3">
        <h1 class="fs-3 fw-bold mb-3">{{ $optionName }}</h1>
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
                <div class="col-4 text-end">
                    <div class="row">
                        <p class="">Durasi: {{ $order->duration }} Bulan</p>
                    </div>
                    <div class="row invisible">
                        <p>Invisible</p>
                    </div>

                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col">
                            @if ($order->status == "accepted")
                            <a class="btn btn-success mb-1" href="/payment/{{ $order->id }}">Bayar</a>
                            @elseif ($order->status == "reviewed")
                            <button class="btn btn-success mb-1" data-bs-target="#lihatReview{{$order->id}}"
                                data-bs-toggle="modal">Lihat
                                Review</button>
                            @elseif ($order->status == "paid")
                            <a class="btn btn-success mb-1" href="/buyers/review/dashboard/{{ $order->id }}">Review</a>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col">
                            @if($order->status =='paid' || $order->status=='reviewed')
                            <a href="/dashboard/order/stop/{{ $order->id }}"><button class="btn btn-danger mb-1"
                                    onclick="return confirm('Apakah anda yakin?')">Berhenti Sewa</button></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if ($order->review)
            <div class="modal fade" id="lihatReview{{$order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content  mt-5">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Review {{$order->review->comment}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
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
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>
@endsection
