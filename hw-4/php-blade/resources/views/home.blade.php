@extends('layouts.default')

@section('content')
<div>
    <h2>The Home Page</h2>
    <h2>Welcome to</h2>
    <h3>Sample</h3>
    <p><span>Name: </span>{{ $name }}</p>
    <p><span>Position: </span>{{ $position }}</p>
    <p><span>Address: </span>{{ $address }}</p>
    <p>
        <span>Age: </span>
        @if($age > 18)
        {{ $age }}
        @else
        Указанный человек слишком молод.
        @endif
    </p>
</div>
@stop
