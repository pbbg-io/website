@extends('layouts.app')

@section('content')

    <section id="intro" class="h-100 w-100 d-flex align-items-center justify-content-center position-relative">
<div id="star-container">
            <div id='stars'></div>
            <div id='stars2'></div>
            <div id='stars3'></div>
        </div>
        <div class="position-absolute text-center" style="bottom: 50px">
            <a href="#features">
                <i data-fa-symbol="chevron-double-down" class="far fa-chevron-double-down fa-2x o-50 animate-flow"></i>
            </a>
        </div>
        <div class="text-center" id="intro-heading">
            <h1 class="display-2">Titan</h1>
            <h5>Text based game engine to develop Persistent Browser Based Games</h5>
        </div>
    </section>

    <section id="features" class="m-5 bg-light p-5">
        <div class="container">
            <div class="row justify-content-center">
                @foreach($features as $feature_title => $feature)
                    <div class="col-sm-12 col-md-4 feature-item @if($loop->iteration != count($features)) mb-5 @endif text-center">
                        <div class="text-center">
                            <div class="icon p-4 text-primary">
                                <i class="{{ $feature['icon'] }} fa-3x"></i>
                            </div>
                            <h3>{{ $feature_title }}</h3>
                        </div>
                        <p>{{ $feature['description'] }}</p>
                    </div>
                    @if($loop->iteration % 3 == 0)
                        <div class="w-100"></div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <section id="github" class="m-5">
        <div class="container">
            <div class="col text-center">
                <h3>Best of all, it's free, forever</h3>
                <h4>Open Source on Github</h4>
                <div class="p-5">
                    <a href="https://github.com/pbbg-io/titan"><i class="fab fa-github fa-4x"></i> </a>
                </div>
                <p>Contribute by reporting issues, developing the core, or building extensions</p>

            </div>
        </div>
    </section>

@endsection
