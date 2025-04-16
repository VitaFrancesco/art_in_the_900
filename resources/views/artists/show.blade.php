@extends('layouts.show')

@section('content')
    <div class="d-flex flex-wrap gap-4 mb-4">
        <div class="imageShow">
            <img src="{{ asset('storage/' . $artist->image) }}" alt="{{ $artist->name }}">
        </div>
        <div class="mainInfo">
            <h1>{{ $artist->name }}</h1>
            @if (!empty($artist->birth_year))
                <p class="mb-1">Nato il&#58; {{ $artist->birth_year }}</p>
            @endif
            @if (!empty($artist->death_year))
                <p class="mb-1">Morto il&#58; {{ $artist->death_year }}</p>
            @endif
            <p class="mb-1">{{ $artist->nationality }}</p>
        </div>
    </div>
    <div class="mb-4">
        <p>{{ $artist->biography }}</p>
    </div>
    <div class="py-3">
        @if ($artist->works->count() >= 4)
            <h4 class="text-center mb-3">Opere</h4>
            <a href="{{ route('works.index', ['search' => $artist->name]) }}">
                <div class="position-relative overflow-hidden wrapper_carousel">
                    @foreach ($artist->works->take(4) as $index => $work)
                        <div class="position-absolute carousel_right element{{ $index + 1 }}">
                            <img src="{{ asset('storage/' . $work->image) }}" alt="{{ 'immagine di ' . $work->title }}">
                        </div>
                    @endforeach
                </div>
            </a>
        @elseif ($artist->works->isNotEmpty())
            <div class="d-flex justify-content-center">
                <a class="btn btn-outline-primary" href="{{ route('works.index', ['search' => $artist->name]) }}">
                    <h4 class="mb-0">
                        <span>Opere </span>
                        <i class="fa-solid fa-arrow-right custom-arrow"></i>
                    </h4>
                </a>
            </div>
        @endif
    </div>
    <div class="py-3">
        @if ($artist->movements->count() >= 4)
            <h4 class="text-center mb-3">Movimenti</h4>
            <a href="{{ route('movements.index', ['search' => $artist->name]) }}">
                <div class="position-relative overflow-hidden wrapper_carousel">
                    @foreach ($artist->movements->take(4) as $index => $movement)
                        <div class="position-absolute carousel_left element{{ $index + 1 }}">
                            <img src="{{ asset('storage/' . $movement->image) }}"
                                alt="{{ 'immagine di ' . $movement->name }}">
                        </div>
                    @endforeach
                </div>
            </a>
        @elseif ($artist->movements->isNotEmpty())
            <div class="d-flex justify-content-center">
                <a class="btn btn-outline-primary" href="{{ route('movements.index', ['search' => $artist->name]) }}">
                    <h4 class="mb-0">
                        <span>Movimenti </span>
                        <i class="fa-solid fa-arrow-right custom-arrow"></i>
                    </h4>
                </a>
            </div>
        @endif
    </div>
@endsection
