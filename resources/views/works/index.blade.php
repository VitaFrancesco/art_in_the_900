@extends('layouts.index')
@php use Illuminate\Support\Str; @endphp

@section('title', 'Opere')

@section('content')
    <div class="row py-4">
        @foreach ($works as $work)
            <div class="col-sm-12 col-md-6 col-lg-4 col-xxl-3 p-3">
                <a href="{{ route('works.show', $work) }}" class="h-100">
                    <div class="card h-100 overflow-hidden">
                        {{-- <img class="card-image-top" src="{{ asset('storage/' . $work->image) }}"
                        alt="{{ 'imamagine di ' . $work->title }}"> --}}
                        <div class="card-body d-flex flex-column">
                            <div class="flex-grow-1 position-relative z-1 mb-2">
                                <h5 class="card-title">{{ $work->title }}</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">{{ $work->artist->name }}</h6>
                                <p class="card-text">{{ Str::limit($work->description, 250, '...') }}</p>
                            </div>
                            <div class="d-flex justify-content-end align-items-baseline gap-2">
                                <span class="more">Mostra</span>
                                <div class="arrow_circle d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-arrow-right custom-arrow"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
