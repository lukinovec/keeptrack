@extends('layouts.app')

@section('title', 'Page Title')
@section('content')
<div class="scrollgif text-center position-absolute d-none">
    <div class="innergif">
        <img src="{{ asset('storage/gif/scrolldown.gif') }}" width="50" alt="Scroll down for search results">
        <h5>Wait and scroll down for search results</h5>
    </div>
</div>
<div class="row h-100 text-center align-items-center px-5">
    <div class="col-sm-6 p-5" id="movies">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36" height="36" class="icon-film">
            <path class="primary"
                d="M4 3h16a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm0 2v2h2V5H4zm0 4v2h2V9H4zm0 4v2h2v-2H4zm0 4v2h2v-2H4zM18 5v2h2V5h-2zm0 4v2h2V9h-2zm0 4v2h2v-2h-2zm0 4v2h2v-2h-2z" />
            <path class="secondary"
                d="M9 5h6a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1H9a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1zm0 8h6a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1H9a1 1 0 0 1-1-1v-4a1 1 0 0 1 1-1z" />
        </svg>
        <h1 class="mb-4 unselectable">Movies & TV Series</h1>
        <div class="row px-sm-0 px-mega-10">
            <div class="col-sm-6" id="search">
                <a href="{{url('tbd')}}" class="homelink">
                    <div class="innerhomelink">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                            class="icon-trophy">
                            <path class="secondary"
                                d="M7 4v2H4v4c0 1.1.9 2 2 2h1v2H6a4 4 0 0 1-4-4V6c0-1.1.9-2 2-2h3zm10 2V4h3a2 2 0 0 1 2 2v4a4 4 0 0 1-4 4h-1v-2h1a2 2 0 0 0 2-2V6h-3zm-3 14h2a1 1 0 0 1 0 2H8a1 1 0 0 1 0-2h2a1 1 0 0 0 1-1v-3h2v3a1 1 0 0 0 1 1z" />
                            <path class="primary" d="M8 2h8a2 2 0 0 1 2 2v7a6 6 0 1 1-12 0V4c0-1.1.9-2 2-2z" /></svg>
                    </div>
                    <h3 class="unselectable">Peoples Favorites</h3>
                </a>
            </div>
            <div class="col-sm-6">
                <a href="{{url('movielist')}}" class="homelink">
                    <div class="innerhomelink">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                            class="icon-menu">
                            <path class="secondary" fill-rule="evenodd"
                                d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z" />
                        </svg>
                    </div>
                    <h3 class="unselectable">Your List</h3>
                </a>
            </div>
        </div>
    </div>
    <div class="col-sm-6 p-5" id="books">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36" height="36" class="icon-book-open">
            <g>
                <path class="secondary"
                    d="M12 21a2 2 0 0 1-1.41-.59l-.83-.82A2 2 0 0 0 8.34 19H4a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h4a5 5 0 0 1 4 2v16z" />
                <path class="primary"
                    d="M12 21V5a5 5 0 0 1 4-2h4a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1h-4.34a2 2 0 0 0-1.42.59l-.83.82A2 2 0 0 1 12 21z" />
            </g>
        </svg>
        <h1 class="mb-4 unselectable">Books</h1>
        <div class="row px-sm-0 px-mega-10">
            <div class="col-sm-6" id="search">
                <a href="{{url('tbd')}}" class="homelink">
                    <div class="innerhomelink">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                            class="icon-trophy">
                            <path class="secondary"
                                d="M7 4v2H4v4c0 1.1.9 2 2 2h1v2H6a4 4 0 0 1-4-4V6c0-1.1.9-2 2-2h3zm10 2V4h3a2 2 0 0 1 2 2v4a4 4 0 0 1-4 4h-1v-2h1a2 2 0 0 0 2-2V6h-3zm-3 14h2a1 1 0 0 1 0 2H8a1 1 0 0 1 0-2h2a1 1 0 0 0 1-1v-3h2v3a1 1 0 0 0 1 1z" />
                            <path class="primary" d="M8 2h8a2 2 0 0 1 2 2v7a6 6 0 1 1-12 0V4c0-1.1.9-2 2-2z" /></svg>
                    </div>
                    <h3 class="unselectable">Peoples Favorites</h3>
                </a>
            </div>
            <div class="col-sm-6">
                <a href="{{url('booklist')}}" class="homelink">
                    <div class="innerhomelink">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                            class="icon-menu">
                            <path class="secondary" fill-rule="evenodd"
                                d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z" />
                        </svg>
                    </div>
                    <h3 class="unselectable">Your List</h3>
                </a>
            </div>
        </div>
    </div>
</div>

<br>
<div class="m-5">
    <div class="searches">
        <Search />
    </div>
</div>
@endsection