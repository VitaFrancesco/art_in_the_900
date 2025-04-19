<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    @include('partials.navbar')
    <main class="container pt-5">
        <div class="d-flex align-items-center justify-content-between">
            <a class="btn btn-outline-primary" href="{{ $indexRoute }}">
                <i class="fa-solid fa-arrow-left"></i> <span>torna alla lista</span>
            </a>
            <div class="d-flex align-items-center justify-content-end gap-2">
                <a class="btn btn-outline-secondary" href="{{ $editRoute }}">
                    <i class="fa-solid fa-pen"></i>
                </a>
                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                    data-bs-target="#deleteEntity">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
        </div>
        <section class="py-4">
            @yield('content')
        </section>
        <div class="modal fade" id="deleteEntity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminazione definitiva</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Sei sicuro di voler eliminare "{{ $whatEliminate }}"?</p>
                        <p>Una volta eliminato non potrà più essere recuperato.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annula</button>
                        <form action="{{ $deleteRoute }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="Elimina Definitivamente">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

{{-- da controller entity, deleteRoute, modifyRoute da pagina content --}}
