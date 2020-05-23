@extends('layouts.app')
@section('content')
<div class="container">
    @if(isset($search->data->Error))
    <h1>{{ $search->data->Error }}</h1>
    @else
    @foreach($search->data->Search as $s)
    <div class="row w-100">
        <div class="col-sm-6 my-4">
            <h4>{{ $s->Title }}, {{ $s->Year }}</h1>
        </div>
    </div>
    @endforeach
    @endif
</div>
@endsection