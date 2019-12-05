@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col">
                <h1>{{ $user->name }}'s Profile</h1>
                <h3>Extensions: {{ $user->extensions->count() }}</h3>
            </div>
        </div>
    </div>

@endsection
