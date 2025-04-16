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
    @include('components.navbar')
    <main class="container pt-5">
        <h1 class="text-center mb-5">@yield('title')</h1>
        <div class="d-flex align-items-center justify-content-between">
            <form class="d-flex" action="{{ $indexRoute }}">
                <input type="text" name="search" placeholder="search..." value="{{ $search }}"
                    class="search_input">
                <button type="submit" class="search_button">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
            <a class="btn btn-outline-primary" href="{{ $createRoute }}">
                @if (Route::currentRouteNamed('artists.index'))
                    <i class="fa-solid fa-user-plus"></i>
                @else
                    <i class="fa-solid fa-plus"></i>
                @endif
            </a>
        </div>
        @yield('content')
        @if ($entity->lastPage() > 1)
            <nav>
                <ul class="pagination justify-content-center">
                    {{-- Previous Page Link --}}
                    @if ($entity->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $entity->previousPageUrl() }}"
                                rel="prev">&laquo;</a></li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($entity->getUrlRange(1, $entity->lastPage()) as $page => $url)
                        @if ($entity->lastPage() > 6)
                            @if ($page == $entity->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                @if ($page == 1 || $page == $entity->lastPage())
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $url }}">{{ $page }}</a></li>
                                @elseif ($page == $entity->currentPage() - 1 || $page == $entity->currentPage() + 1)
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $url }}">{{ $page }}</a></li>
                                @elseif ($page == 2 || $page == $entity->lastPage() - 1)
                                    <li class="page-item"><span class="page-link">...</span></li>
                                @endif
                            @endif
                        @else
                            @if ($page == $entity->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link"
                                        href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($entity->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $entity->nextPageUrl() }}"
                                rel="next">&raquo;</a></li>
                    @else
                        <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                    @endif
                </ul>
            </nav>
        @endif
    </main>
</body>
