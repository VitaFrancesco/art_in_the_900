@extends('layouts.create')

@section('content')
    <h1 class="text-center mb-4">Nuova Opera</h1>
    <form action="{{ route('works.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">
            <div class="editImage position-relative">
                <div id="imageCircle" class="hidden_input_image create">
                    <label for="image" class="form-label"><i class="fa-solid fa-pen"></i></label>
                    <input type="file" class="d-none" id="image" name="image">
                </div>
                <img id="previewImage" class="max-20" alt="#">
            </div>
            <div class="editForm">
                <div class="mb-3">
                    <label for="title" class="form-label">Titolo dell'opera</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="artist_id" class="form-label">Artista</label>
                    <select name="artist_id" id="artist_id" class="form-select" aria-label="Default select example">
                        <option selected disabled>Seleziona</option>
                        @foreach ($artists as $artist)
                            <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="movement_id" class="form-label">Movimento</label>
                    <select name="movement_id" id="movement_id" class="form-select" aria-label="Default select example">
                        <option selected disabled>Seleziona</option>
                        @foreach ($movements as $movement)
                            <option value="{{ $movement->id }}">{{ $movement->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row mb-3 align-items-center">
            <div class="col-sm-12 col-md-6 col-xl-4">
                <label for="museum" class="form-label">Museo</label>
                <input type="text" class="form-control" id="museum" name="museum">
            </div>
            <div class="col-sm-12 col-md-6 col-xl-4">
                <label for="creation_year" class="form-label">Anno di creazione</label>
                <select name="creation_year" id="creation_year" class="form-select">
                    <option selected disabled>Seleziona</option>
                    @for ($year = 2000; $year >= 1900; $year--)
                        <option>{{ $year }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-4">
                <label for="technique" class="form-label">Tecnica Utilizzata</label>
                <input type="text" class="form-control" id="technique" name="technique">
            </div>
            <div class="col-sm-12 col-md-6 col-xl-4">
                <label for="width" class="form-label">Larghezza</label>
                <input type="number" class="form-control" id="museum" name="width">
            </div>
            <div class="col-sm-12 col-md-6 col-xl-4">
                <label for="height" class="form-label">Altezza</label>
                <input type="number" class="form-control" id="height" name="height">
            </div>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea class="form-control" id="description" name="description" rows="7"></textarea>
        </div>
        <div class="d-flex align-items-center justify-content-center gap-5">
            <button type="reset" class="btn btn-secondary px-4">Annulla</button>
            <button type="submit" class="btn btn-primary px-4">Crea</button>
        </div>
    </form>
    <script>
        const input = document.getElementById('image');
        const preview = document.getElementById('previewImage');
        const imageCircle = document.getElementById('imageCircle');

        input.addEventListener('change', function() {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                };

                imageCircle.classList.remove('create');

                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
