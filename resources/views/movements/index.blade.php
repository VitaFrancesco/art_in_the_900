@extends('layouts.index')
@php use Illuminate\Support\Str; @endphp

@section('title', 'Movimenti')

@section('content')
    <div class="row py-4">
        @foreach ($movements as $movement)
            <div class="col-sm-12 col-md-6 col-lg-4 col-xxl-3 p-3">
                <a href="{{ route('movements.show', $movement) }}" class="h-100">
                    <div class="card h-100 overflow-hidden">
                        <div class="card-image-top">
                            <img src="{{ asset('storage/' . $movement->image) }}"
                                alt="{{ 'imamagine di ' . $movement->title }}">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="flex-grow-1 position-relative z-1 mb-2">
                                <h5 class="card-title">{{ $movement->name }}</h5>
                                <p class="card-text">{!! nl2br(e(Str::limit($movement->description, 250, '...'))) !!}</p>
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
