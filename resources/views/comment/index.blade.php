@extends('layouts.main')

@section('main-content')
<!-- navbar section -->
@include('partials.navbar2')
<link href="css/star-rating.css" rel="stylesheet">

<div class="container p-3 mt-4" style="width: 50%;">
    <h1 class="text-center">Komentar</h1>
    <div class="comment border rounded p-3" style="background-color: #E7F9FD;">
        <form action="/buyers/review/{{$property->slug}}" method="post">
            @csrf
            <div class="login-bg">
                <label for="comment" class="form-label">Komentar</label>
                <textarea class="form-control" name="comment" id="comment" placeholder="Tulis komentar anda">{{old('comment')}}</textarea>
                <br>
                <label for="rating" class="form-label">Rating</label>
                <select name="rating" id="star-rating">
                    {{old('rating')}}
                    <option value="5">5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2">2</option>
                    <option value="1">1</option>
                </select>
                <br>
                <button type='submit' class="btn btn-primary mt-2">Tambah</button>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="js/star-rating.js"></script>
{{-- jQuery --}}
<script>
    var stars = new StarRating('#star-rating', {
                maxStars: 5,
            });
</script>

<!-- footer section  -->
@include('partials.footer')
@endsection