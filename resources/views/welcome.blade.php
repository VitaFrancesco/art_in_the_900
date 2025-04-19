@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-center align-items-center height_custom_100vh">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-4 p-3 h-100 d-flex align-content-center flex-wrap">
                    <a class="w-100" href="{{ route('artists.index') }}">
                        <div class="w-100 overflow-hidden home_link_card">
                            <h2 class="text">Artisti</h2>
                            <img src="{{ Vite::asset('resources/img/artists.png') }}" alt="Artisti del '900">
                        </div>
                    </a>
                </div>
                <div class="col-4 p-3 h-100 d-flex align-content-center flex-wrap">
                    <a class="w-100" href="{{ route('works.index') }}">
                        <div class="w-100 overflow-hidden home_link_card">
                            <h2 class="text">Opere</h2>
                            <img src="{{ Vite::asset('resources/img/works.png') }}" alt="Opere del '900">
                        </div>
                    </a>
                </div>
                <div class="col-4 p-3 h-100 d-flex align-content-center flex-wrap">
                    <a class="w-100" href="{{ route('movements.index') }}">
                        <div class="w-100 overflow-hidden home_link_card">
                            <h2 class="text">Movimenti</h2>
                            <img src="{{ Vite::asset('resources/img/movements.png') }}" alt="Movimenti del '900">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
