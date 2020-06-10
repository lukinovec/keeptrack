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
            <h3>Status</h3>
        </div>
        <div class="col-sm-2">
            <h3>Episodes Watched</h3>
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

        <div class="col-sm-2">
            {{ $movie->status }}
        </div>
        <div class="col-sm-2">
            @if ( $movie->status == "Currently Watching" & $movie->type != "movie" )
            <div class="row align-items-center">
                <form action="{{ route('updateProgress', ['id' => $movie->id]) }}" id="progressForm" method="post">
                    @csrf
                    <input autocomplete="off" name="progress" value="{{ $movie->progress_episodes }}"
                        class="form-control col-sm-3">
                    <input type="submit" value="+" class="btn btn-primary btn-sm col-sm-3">
                </form>
            </div>
            @endif
        </div>

    </div>
    @endforeach
</div>
@endsection