<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Work;
use App\Models\Artist;
use App\Models\Movement;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $indexRoute = route('artists.index');
        $createRoute = route('artists.create');
        $search = $data['search'] ?? '';
        if (array_key_exists('search', $data)) {
            $artists = Artist::with(['movements', 'works'])
                ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhereHas('movements', function ($movementQuery) use ($search) {
                        $movementQuery->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('works', function ($workQuery) use ($search) {
                        $workQuery->where('title', 'like', "%{$search}%");
                    });
        })
        ->paginate(10)
        ->appends(['search' => $search]);
        } else {
            $artists = Artist::with(['movements', 'works'])->paginate(10);
        }
        $entity = $artists;
        return view('artists.index', compact('artists', 'indexRoute', 'createRoute', 'search', 'entity'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
