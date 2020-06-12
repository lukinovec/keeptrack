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
            <h3>Author</h3>
        </div>

        <div class="col-sm-2">
            <h3>Status</h3>
        </div>
        <div class="col-sm-2">
            <h3>Pages Read</h3>
        </div>
    </div>
    @foreach ($data as $book)
    <div class="row align-items-center border-bottom">
        <div class="col-sm-4">
            {{ $book->name }}
        </div>
        <div class="col-sm-1">
            <img src=" {{ $book->image }} " width="50" alt="">
        </div>
        <div class="col-sm-3">
            {{ $book->author }}
        </div>

        <div class="col-sm-2">
            {{ $book->status }}
        </div>
        <div class="col-sm-2">
            @if ( $book->status == "Currently Reading" )
            <div class="row align-items-center">
                <form action="{{ route('updateProgressBooks', ['id' => $book->id]) }}" id="progressForm" method="post">
                    @csrf
                    <input autocomplete="off" name="progress" value="{{ $book->progress_pages }}"
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