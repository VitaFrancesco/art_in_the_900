@extends('layouts.create')

@section('content')
    <h1 class="text-center mb-4">Nuovo Movimento</h1>
    <form action="{{ route('movements.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">
            <div class="editImage position-relative">
                <div id="imageCircle" class="hidden_input_image">
                    <label for="image" class="form-label"><i class="fa-solid fa-pen"></i></label>
                    <input type="file" class="d-none" id="image" name="image">
                </div>
                <img id="previewImage" class="max-20" alt="#">
            </div>
            <div class="editForm">
                <div class="mb-3">
                    <label for="name" class="form-label">Nome del movimeto</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="start_year" class="form-label">Anno di inizio</label>
                    <select name="start_year" id="start_year" class="form-select">
                        <option disabled selected>Seleziona</option>
                        @for ($year = 2000; $year >= 1900; $year--)
                            <option>{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                <div class="mb-3">
                    <label for="end_year" class="form-label">Anno di fine</label>
                    <select name="end_year" id="end_year" class="form-select">
                        <option disabled selected>Seleziona</option>
                        @for ($year = 2000; $year >= 1900; $year--)
                            <option>{{ $year }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
        <div class="py-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea class="form-control" id="description" name="description" rows="7"></textarea>
        </div>
        <div class="py-3 d-flex flex-align-items-center gap-2 flex-wrap">
            @foreach ($artists as $artist)
                <input class="btn-check" type="checkbox" id="artist-{{ $artist->id }}" name="artists[]"
                    value="{{ $artist->id }}">
                <label for="artist-{{ $artist->id }}" class="btn btn-outline-dark">{{ $artist->name }}</label>
            @endforeach
        </div>
        <div class="d-flex align-items-center justify-content-center gap-5">
            <button type="reset" class="btn btn-secondary px-4">Annulla modifiche</button>
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
