@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
<div class="row h-100 text-center align-items-center px-5">

    <div class="col-sm-6 p-5" id="movies">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36" height="36" class="icon-film">
            <path class="primary"
                d="M4 3h16a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm0 2v2h2V5H4zm0 4v2h2V9H4zm0 4v2h2v-2H4zm0 4v2h2v-2H4zM18 5v2h2V5h-2zm0 4v2h2V9h-2zm0 4v2h2v-2h-2zm0 4v2h2v-2h-2z" />
            <path class="secondary"
                d="M9 5h6a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1H9a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1zm0 8h6a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1H9a1 1 0 0 1-1-1v-4a1 1 0 0 1 1-1z" />
        </svg>
        <h1 class="mb-4">Movies & TV Series</h1>
        <div class="row px-sm-0 px-mega-10">
            <div class="col-sm-6" id="search">
                <a href="{{url('moviesearch')}}" class="homelink">
                    <div class="innerhomelink">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                            class="icon-search">
                            <circle cx="10" cy="10" r="7" fill="white" />
                            <path class="secondary"
                                d="M16.32 14.9l1.1 1.1c.4-.02.83.13 1.14.44l3 3a1.5 1.5 0 0 1-2.12 2.12l-3-3a1.5 1.5 0 0 1-.44-1.14l-1.1-1.1a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z" />
                        </svg>
                    </div>
                    <h3>Search</h3>
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
                    <h3>Your List</h3>
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
        <h1 class="mb-4">Books</h1>
        <div class="row px-sm-0 px-mega-10">
            <div class="col-sm-6" id="search">
                <a href="{{url('booksearch')}}" class="homelink">
                    <div class="innerhomelink">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                            class="icon-search">
                            <circle cx="10" cy="10" r="7" fill="white" />
                            <path class="secondary"
                                d="M16.32 14.9l1.1 1.1c.4-.02.83.13 1.14.44l3 3a1.5 1.5 0 0 1-2.12 2.12l-3-3a1.5 1.5 0 0 1-.44-1.14l-1.1-1.1a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z" />
                        </svg>
                    </div>
                    <h3>Search</h3>
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
                    <h3>Your List</h3>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection