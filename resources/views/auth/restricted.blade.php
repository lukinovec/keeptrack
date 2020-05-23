@extends('layouts.app')
@section('content')
<div class="text-center">
    Access restricted - you have to <a href="{{ url('login') }}">log in</a>. <a
        href="{{ url('register') }}">Register</a> if
    you don't have
    an account.
</div>
@endsection