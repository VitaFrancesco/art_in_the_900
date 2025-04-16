@extends('layouts.show')

@section('content')
    <div class="d-flex flex-wrap gap-4 mb-4">
        <div class="imageShow">
            <img src="{{ asset('storage/' . $work->image) }}" alt="{{ $work->title }}">
        </div>
        <div class="mainInfo">
            <h1>{{ $work->title }}</h1>
            <a class="link_custom" href="{{ route('artists.show', $work->artist) }}">
                <h4>{{ $work->artist->name . ' ' . $work->creation_year }}</h4>
            </a>
            <a class="link_custom" href="{{ route('movements.show', $work->movement) }}">
                <p class="mb-1">{{ $work->movement->name }}</p>
            </a>
            <p class="mb-1">{{ $work->museum }}</p>
        </div>
    </div>
    <div>
        <p>{!! nl2br(e($work->description)) !!}</p>
    </div>
@endsection
