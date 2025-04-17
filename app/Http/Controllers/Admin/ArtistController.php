<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Work;
use App\Models\Artist;
use App\Models\Movement;

use Illuminate\Support\Facades\Storage;

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
        $movements = Movement::all();
        $indexRoute = route('artists.index');
        return view('artists.create', compact('indexRoute', 'movements'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $artist = new Artist();

        $artist->name = $data['name'];
        $artist->birth_date = $data['birth_date'];
        $artist->death_date = $data['death_date'];
        $artist->nationality = $data['nationality'];
        $artist->biography = $data['biography'];

        if(array_key_exists('image', $data)) {            
            $image_url = Storage::putFile('artists', $data['image']);
            $artist->image = $image_url;
        }

        $artist->save();

        if ($request->has('movements')) {
            $artist->movements()->attach($data['movements']);
        }

        return redirect()->route('artists.show', $artist);
    }

    /**
     * Display the specified resource.
     */
    public function show(Artist $artist)
    {
        $indexRoute = route('artists.index');
        $deleteRoute = route('artists.destroy', $artist);
        $editRoute = route('artists.edit', $artist);
        $whatEliminate = $artist->name;
        return view('artists.show', compact('artist', 'deleteRoute', 'editRoute', 'whatEliminate', 'indexRoute'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artist $artist)
    {
        $movements = Movement::all();
        $showRoute = route('artists.show', $artist);
        return view('artists.edit', compact('artist', 'showRoute', 'movements'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artist $artist)
    {
        $data = $request->all();

        $artist->name = $data['name'];
        $artist->birth_date = $data['birth_date'];
        $artist->death_date = $data['death_date'];
        $artist->nationality = $data['nationality'];
        $artist->biography = $data['biography'];

        if(array_key_exists('image', $data)) {
            
            if($artist->image) {
                Storage::delete($artist->image);
            }
            
            $image_url = Storage::putFile('artists', $data['image']);
            
            $artist->image = $image_url;
        }

        $artist->update();

        if ($request->has('movements')) {
            $artist->movements()->sync($data['movements']);
        } else {
            $artist->movements()->detach();
        }

        return redirect()->route('artists.show', $artist);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artist $artist)
    {
        if ($artist->image) {
            Storage::delete($artist->image);
        }
        $artist->delete();
        return redirect()->route('artists.index');
    }
}
