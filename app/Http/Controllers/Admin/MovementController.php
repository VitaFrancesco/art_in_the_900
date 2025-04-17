<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Work;
use App\Models\Artist;
use App\Models\Movement;

use Illuminate\Support\Facades\Storage;

class MovementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $indexRoute = route('movements.index');
        $createRoute = route('movements.create');
        $search = $data['search'] ?? '';
        if (array_key_exists('search', $data)) {
            $movements = Movement::with(['artists', 'works'])
                ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhereHas('artists', function ($artistQuery) use ($search) {
                        $artistQuery->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('works', function ($workQuery) use ($search) {
                        $workQuery->where('title', 'like', "%{$search}%");
                    });
        })
        ->paginate(10)
        ->appends(['search' => $search]);
        } else {
            $movements = Movement::with(['artists', 'works'])->paginate(10);
        }
        $entity = $movements;
        return view('movements.index', compact('movements', 'indexRoute', 'createRoute', 'search', 'entity'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $artists = Artist::all();
        $indexRoute = route('movements.index');
        return view('movements.create', compact('indexRoute', 'artists'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $movement = new Movement();

        $movement->name = $data['name'];
        $movement->start_year = $data['start_year'];
        $movement->end_year = $data['end_year'];
        $movement->description = $data['description'];

        if(array_key_exists('image', $data)) {
            $image_url = Storage::putFile('movements', $data['image']);
            $movement->image = $image_url;
        }

        $movement->save();

        if ($movement->has('artists')) {
            $movement->artists()->attach($data['artists']);
        }

        return redirect()->route('movements.show', $movement);
    }

    /**
     * Display the specified resource.
     */
    public function show(Movement $movement)
    {
        $indexRoute = route('movements.index');
        $deleteRoute = route('movements.destroy', $movement);
        $editRoute = route('movements.edit', $movement);
        $whatEliminate = $movement->name;
        return view('movements.show', compact('movement', 'deleteRoute', 'editRoute', 'whatEliminate', 'indexRoute'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movement $movement)
    {
        $artists = Artist::all();
        $showRoute = route('movements.show', $movement);
        return view('movements.edit', compact('movement', 'showRoute', 'artists'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movement $movement)
    {
        $data = $request->all();

        $movement->name = $data['name'];
        $movement->start_year = $data['start_year'];
        $movement->end_year = $data['end_year'];
        $movement->description = $data['description'];

        if(array_key_exists('image', $data)) {
            
            if($movement->image) {
                Storage::delete($movement->image);
            }
            
            $image_url = Storage::putFile('works', $data['image']);
            
            $movement->image = $image_url;
        }

        $movement->update();

        if ($request->has('artists')) {
            $movement->artists()->sync($data['artists']);
        } else {
            $movement->artists()->detach();
        }

        return redirect()->route('movements.show', $movement);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movement $movement)
    {
        if ($movement->image) {
            Storage::delete($movement->image);
        }
        $movement->delete();
        return redirect()->route('movements.index');
    }
}
