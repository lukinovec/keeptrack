@extends('layouts/app')
@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-sm-4">
            <h1>Title</h1>
        </div>
        <div class="col-sm-3">
            <h1>Director</h1>
        </div>
        <div class="col-sm-2">
            <h1>Status</h1>
        </div>
        <div class="col-sm-3">
            <h1>Poster</h1>
        </div>
    </div>
    @foreach ($data as $movie)
    <div class="row">
        <div class="col-sm-4">
            {{ $movie->name }}
        </div>
        <div class="col-sm-3">
            {{ $movie->director }}
        </div>
        <div class="col-sm-2">
            {{ $movie->status }}
        </div>
        <div class="col-sm-3">
            <img src=" {{ $movie->image }} " width="50" alt="">
        </div>
    </div>
    @endforeach
</div>
@endsection