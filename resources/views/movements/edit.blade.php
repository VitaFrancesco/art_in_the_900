@extends('layouts.edit')

@section('content')
    <h1 class="text-center mb-4">Modifica Movimento</h1>
    <form action="{{ route('movements.update', $movement) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">
            <div class="editImage position-relative">
                <div id="imageCircle" class="hidden_input_image">
                    <label for="image" class="form-label"><i class="fa-solid fa-pen"></i></label>
                    <input type="file" class="d-none" id="image" name="image">
                </div>
                @if ($movement->image)
                    <img id="previewImage" class="max-20" src="{{ asset('storage/' . $movement->image) }}" alt="#">
                @endif
            </div>
            <div class="editForm">
                <div class="mb-3">
                    <label for="name" class="form-label">Nome del movimeto</label>
                    <input value="{{ $movement->name }}" type="text" class="form-control" id="name" name="name"
                        required>
                </div>
                <div class="mb-3">
                    <label for="start_year" class="form-label">Anno di inizio</label>
                    <select name="start_year" id="start_year" class="form-select">
                        @for ($year = 2000; $year >= 1900; $year--)
                            <option value="{{ $movement->start_year }}"
                                {{ $movement->start_year == $year ? 'selected' : '' }}>
                                {{ $year }}</option>
                        @endfor
                    </select>
                </div>
                <div class="mb-3">
                    <label for="end_year" class="form-label">Anno di fine</label>
                    <select name="end_year" id="end_year" class="form-select">
                        @for ($year = 2000; $year >= 1900; $year--)
                            <option value="{{ $movement->end_year }}" {{ $movement->end_year == $year ? 'selected' : '' }}>
                                {{ $year }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
        <div class="py-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea class="form-control" id="description" name="description" rows="7">{{ $movement->description }}</textarea>
        </div>
        <div class="py-3 d-flex flex-align-items-center gap-2 flex-wrap">
            @foreach ($artists as $artist)
                <input class="btn-check" type="checkbox" id="artist-{{ $artist->id }}" name="artists[]"
                    value="{{ $artist->id }}" {{ $movement->artists->contains($artist) ? 'checked' : '' }}>
                <label for="artist-{{ $artist->id }}" class="btn btn-outline-dark">{{ $artist->name }}</label>
            @endforeach
        </div>
        <div class="d-flex align-items-center justify-content-center gap-5">
            <button type="reset" class="btn btn-secondary px-4">Annulla</button>
            <button type="submit" class="btn btn-primary px-4">Aggiorna</button>
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
