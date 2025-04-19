@extends('layouts.show')

@section('content')
    <div class="d-flex flex-wrap gap-4 mb-4">
        <div class="imageShow">
            <img src="{{ asset('storage/' . $work->image) }}" alt="{{ $work->title }}">
        </div>
        <div class="mainInfo">
            <h1>{{ $work->title }}</h1>
            <a class="link_custom" href="{{ route('artists.show', $work->artist) }}">
                <h4>{{ $work->artist->name }}
                    &#x28;{{ $work->artist->birth_date }}&#x2f;{{ $work->artist->birth_date }}&#x29;</h4>
            </a>
            <a class="link_custom" href="{{ route('movements.show', $work->movement) }}">
                <p class="mb-1">Movimento&#x3a; {{ $work->movement->name }}</p>
            </a>
            @if ($work->museum)
                <p class="mb-1">Museo&#x3a; {{ $work->museum }}</p>
            @endif
            @if ($work->creation_year)
                <p class="mb-1">Anno di creazion&#x3a; {{ $work->creation_year }}</p>
            @endif
            @if ($work->tecnique)
                <p class="mb-1">Tecnica&#x3a; {{ $work->tecnique }}</p>
            @endif
            @if ($work->width && $work->height)
                <p class="mb-1">Dimensioni&#x3a; {{ $work->width }}cm &#xd7; {{ $work->height }}cm</p>
            @endif
        </div>
    </div>
    <div>
        <p>{!! nl2br(e($work->description)) !!}</p>
    </div>
@endsection
