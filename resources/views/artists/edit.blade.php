@extends('layouts.edit')

@section('content')
    <h1 class="text-center mb-4">Modifica Artista</h1>
    <form action="{{ route('artists.update', $artist) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">
            <div class="editImage position-relative">
                <div id="imageCircle" class="hidden_input_image">
                    <label for="image" class="form-label"><i class="fa-solid fa-pen"></i></label>
                    <input type="file" class="d-none" id="image" name="image">
                </div>
                @if ($artist->image)
                    <img id="previewImage" class="max-20" src="{{ asset('storage/' . $artist->image) }}" alt="#">
                @endif
            </div>
            <div class="editForm">
                <div class="mb-3">
                    <label for="name" class="form-label">Nome dell'artista</label>
                    <input value="{{ $artist->name }}" type="text" class="form-control" id="name" name="name"
                        required>
                </div>
                <div class="mb-3">
                    <label for="birth_date" class="form-label">Data di nascita</label>
                    <input type="date" class="form-control" id="birth_date" name="birth_date"
                        value="{{ $artist->birth_date }}">
                </div>
                <div class="mb-3">
                    <label for="death_date" class="form-label">Data di morte</label>
                    <input type="date" class="form-control" id="death_date" name="death_date"
                        value="{{ $artist->death_date }}">
                </div>
                <div class="mb-3">
                    <label for="nationality" class="form-label">Nazionalità</label>
                    <input type="text" class="form-control" id="nationality" name="nationality"
                        value="{{ $artist->nationality }}" required>
                </div>
            </div>
        </div>
        <div class="py-3">
            <label for="biography" class="form-label">Biografia</label>
            <textarea class="form-control" id="biography" name="biography" rows="7" required>{{ $artist->biography }}</textarea>
        </div>
        <div class="py-3 d-flex flex-align-items-center gap-2 flex-wrap">
            @foreach ($movements as $movement)
                <input class="btn-check" type="checkbox" id="movement-{{ $movement->id }}" name="movements[]"
                    value="{{ $movement->id }}" {{ $artist->movements->contains($movement) ? 'checked' : '' }}>
                <label for="movement-{{ $movement->id }}" class="btn btn-outline-dark">{{ $movement->name }}</label>
            @endforeach
        </div>
        <div class="d-flex align-items-center justify-content-center gap-5">
            <button type="reset" class="btn btn-secondary px-4">Annulla modifiche</button>
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
