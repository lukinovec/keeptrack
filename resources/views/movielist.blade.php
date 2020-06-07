@extends('layouts/app')
@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-sm-4">
            <h3>Title</h3>
        </div>
        <div class="col-sm-1">
        </div>
        <div class="col-sm-3">
            <h3>Director</h3>
        </div>
        <div class="col-sm-2">
            <h3>Episodes Watched</h3>
        </div>
        <div class="col-sm-2">
            <h3>Status</h3>
        </div>

    </div>
    @foreach ($data as $movie)
    <div class="row align-items-center border-bottom">
        <div class="col-sm-4">
            {{ $movie->name }}
        </div>
        <div class="col-sm-1">
            <img src=" {{ $movie->image }} " width="50" alt="">
        </div>
        <div class="col-sm-3">
            {{ $movie->director }}
        </div>
        <div class="col-sm-1">
            @if ( $movie->status == "Currently Watching" )
            <div class="row">
                <button type="submit" class="btn btn-primary btn-sm">+</button>
                <input value="{{ $movie->progress_episodes }}" class="form-control col-sm-5">
            </div>
            @endif
        </div>
        <div class="col-sm-2">
            {{ $movie->status }}
        </div>


    </div>
    @endforeach
</div>
@endsection