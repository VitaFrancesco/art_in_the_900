@extends('layouts.edit')

@section('content')
    <h1 class="text-center mb-4">Modifica Opera</h1>
    <form action="{{ route('works.update', $work) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">
            <div class="editImage position-relative">
                <div class="hidden_input_image">
                    <label for="image" class="form-label"><i class="fa-solid fa-pen"></i></label>
                    <input type="file" class="d-none" id="image" name="image">
                </div>
                @if ($work->image)
                    <img class="max-20" src="{{ asset('storage/' . $work->image) }}" alt="#">
                @endif
            </div>
            <div class="editForm">
                <div class="mb-3">
                    <label for="title" class="form-label">Titolo dell'opera</label>
                    <input type="text" class="form-control" id="title" name="title" required
                        value="{{ $work->title }}">
                </div>
                <div class="mb-3">
                    <label for="artist_id" class="form-label">Artista</label>
                    <select name="artist_id" id="artist_id" class="form-select" aria-label="Default select example">
                        @foreach ($artists as $artist)
                            <option value="{{ $artist->id }}" {{ $artist->id == $work->artist_id ? 'selected' : '' }}>
                                {{ $artist->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="movement_id" class="form-label">Movimento</label>
                    <select name="movement_id" id="movement_id" class="form-select" aria-label="Default select example">
                        @foreach ($movements as $movement)
                            <option value="{{ $movement->id }}" {{ $movement->id == $work->movement_id ? 'selected' : '' }}>
                                {{ $movement->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row mb-3 align-items-center">
            <div class="col-sm-12 col-md-6 col-xl-4">
                <label for="museum" class="form-label">Museo</label>
                <input type="text" class="form-control" id="museum" name="museum" value="{{ $work->museum }}">
            </div>
            <div class="col-sm-12 col-md-6 col-xl-4">
                <label for="creation_year" class="form-label">Anno di creazione</label>
                <select name="creation_year" id="creation_year" class="form-select">
                    @for ($year = 2000; $year >= 1900; $year--)
                        <option value="{{ $work->creation_year }}" {{ $work->creation_year == $year ? 'selected' : '' }}>
                            {{ $year }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-4">
                <label for="technique" class="form-label">Tecnica Utilizzata</label>
                <input type="text" class="form-control" id="technique" name="technique" value="{{ $work->technique }}">
            </div>
            <div class="col-sm-12 col-md-6 col-xl-4">
                <label for="width" class="form-label">Larghezza in cm</label>
                <input type="number" class="form-control" id="museum" name="width" value="{{ $work->width }}">
            </div>
            <div class="col-sm-12 col-md-6 col-xl-4">
                <label for="height" class="form-label">Altezza in cm</label>
                <input type="number" class="form-control" id="height" name="height" value="{{ $work->height }}">
            </div>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea class="form-control" id="description" name="description" rows="7">{{ $work->description }}</textarea>
        </div>
        <div class="d-flex align-items-center justify-content-center gap-5">
            <button type="reset" class="btn btn-secondary px-4">Annulla</button>
            <button type="submit" class="btn btn-primary px-4">Aggiorna</button>
        </div>
    </form>
@endsection
