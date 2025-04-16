<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Work;
use App\Models\Artist;
use App\Models\Movement;

use Illuminate\Support\Facades\Storage;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $indexRoute = route('works.index');
        $createRoute = route('works.create');
        $search = $data['search'] ?? '';
        if (array_key_exists('search', $data)) {
            $works = Work::with(['artist', 'movement'])
                ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhereHas('artist', function ($artistQuery) use ($search) {
                        $artistQuery->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('movement', function ($movementQuery) use ($search) {
                        $movementQuery->where('name', 'like', "%{$search}%");
                    });
        })
        ->paginate(10)
        ->appends(['search' => $search]);
        } else {
            $works = Work::with(['artist', 'movement'])->paginate(10);
        }
        $entity = $works;
        return view('works.index', compact('works', 'indexRoute', 'createRoute', 'search', 'entity'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $artists = Artist::all();
        $movements = Movement::all();
        $indexRoute = route('works.index');
        return view('works.create', compact('indexRoute', 'artists', 'movements'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $work = new Work();

        $work->title = $data['title'];
        $work->museum = $data['museum'];
        $work->creation_year = $data['creation_year'];
        $work->technique = $data['technique'];
        $work->width = $data['width'];
        $work->height = $data['height'];
        $work->artist_id = $data['artist_id'];
        $work->movement_id = $data['movement_id'];
        $work->description = $data['description'];

        if(array_key_exists('image', $data)) {
            $image_url = Storage::putFile('works', $data['image']);
            $work->image = $image_url;
        }

        $work->save();

        return redirect()->route('works.show', $work);
    }

    /**
     * Display the specified resource.
     */
    public function show(Work $work)
    {
        $indexRoute = route('works.index');
        $deleteRoute = route('works.destroy', $work);
        $editRoute = route('works.edit', $work);
        $whatEliminate = $work->title;
        return view('works.show', compact('work', 'deleteRoute', 'editRoute', 'whatEliminate', 'indexRoute'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Work $work)
    {
        $artists = Artist::all();
        $movements = Movement::all();
        $showRoute = route('works.show', $work);
        return view('works.edit', compact('work', 'showRoute', 'artists', 'movements'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Work $work)
    {
        $data = $request->all();

        $work->title = $data['title'];
        $work->museum = $data['museum'];
        $work->creation_year = $data['creation_year'];
        $work->technique = $data['technique'];
        $work->width = $data['width'];
        $work->height = $data['height'];
        $work->artist_id = $data['artist_id'];
        $work->movement_id = $data['movement_id'];
        $work->description = $data['description'];

        if(array_key_exists('image', $data)) {
            
            if($work->image) {
                Storage::delete($work->image);
            }
            
            $image_url = Storage::putFile('works', $data['image']);
            
            $work->image = $image_url;
        }

        $work->update();

        return redirect()->route('works.show', $work);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Work $work)
    {
        if ($work->image) {
            Storage::delete($work->image);
        }
        $work->delete();
        return redirect()->route('works.index');
    }
}
