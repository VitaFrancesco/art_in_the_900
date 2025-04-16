@extends('layouts.show')

@section('content')
    <div class="d-flex flex-wrap gap-4 mb-4">
        <div class="imageShow">
            <img src="{{ asset('storage/' . $movement->image) }}" alt="{{ $movement->name }}">
        </div>
        <div class="mainInfo">
            <h1>{{ $movement->name }}</h1>
            <h4 class="mb-1">{{ $movement->start_year . '-' . $movement->end_year }}</h4>
        </div>
    </div>
    <div class="mb-4">
        <p>{!! nl2br(e($movement->description)) !!}</p>
    </div>
    <div class="py-3">
        @if ($movement->artists->count() >= 4)
            <h4 class="text-center mb-3">Artisti</h4>
            <a href="{{ route('artists.index', ['search' => $movement->name]) }}">
                <div class="position-relative overflow-hidden wrapper_carousel">
                    @foreach ($movement->artists->take(4) as $index => $artist)
                        <div class="position-absolute carousel_left element{{ $index + 1 }}">
                            <img src="{{ asset('storage/' . $artist->image) }}" alt="{{ 'immagine di ' . $artist->name }}">
                        </div>
                    @endforeach
                </div>
            </a>
        @elseif ($movement->artists->isNotEmpty())
            <div class="d-flex justify-content-center">
                <a class="btn btn-outline-primary" href="{{ route('artists.index', ['search' => $movement->name]) }}">
                    <h4 class="mb-0">
                        <span>Artisti </span>
                        <i class="fa-solid fa-arrow-right custom-arrow"></i>
                    </h4>
                </a>
            </div>
        @endif
    </div>
    <div class="py-3">
        @if ($movement->works->count() >= 4)
            <h4 class="text-center mb-3">Opere</h4>
            <a href="{{ route('works.index', ['search' => $movement->name]) }}">
                <div class="position-relative overflow-hidden wrapper_carousel">
                    <@foreach ($movement->works->take(4) as $index => $work)
                        <div class="position-absolute carousel_right element{{ $index + 1 }}">
                            <img src="{{ asset('storage/' . $work->image) }}" alt="{{ 'immagine di ' . $work->title }}">
                        </div>
        @endforeach
    </div>
    </a>
@elseif ($movement->works->isNotEmpty())
    <div class="d-flex justify-content-center">
        <a class="btn btn-outline-primary" href="{{ route('works.index', ['search' => $movement->name]) }}">
            <h4 class="mb-0">
                <span>Opere </span>
                <i class="fa-solid fa-arrow-right custom-arrow"></i>
            </h4>
        </a>
    </div>
    @endif
    </div>
@endsection
