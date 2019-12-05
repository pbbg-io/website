@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col">
                <h1>{{ $extension->name }}</h1>
                <div class="rating mb-3">
                    @for($i=0;$i<$extension->rating;$i++)
                        <i class="fas fa-star text-primary"></i>
                    @endfor
                </div>
                <div class="extension-meta"><i class="fas fa-user text-primary"></i> <a href="{{ route('profile', $extension->authorMeta->name) }}">{{ $extension->authorMeta->name }}</a> - <i class="fas fa-star text-primary"></i> {{ number_format($extension->ratings) }} Ratings - <i class="fas fa-arrow-circle-down text-primary"></i> {{ number_format($extension->installs) }} Installs</div>
            </div>
        </div>
    </div>

@endsection
