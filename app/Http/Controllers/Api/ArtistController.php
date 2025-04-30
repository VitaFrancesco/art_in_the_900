<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Work;
use App\Models\Artist;
use App\Models\Movement;


class ArtistController extends Controller
{
    public function index(Request $request) {
        $data = $request->all();
        $search = $data['search'] ?? '';

        if (array_key_exists('search', $data)) {
            $artists = Artist::with(['movements', 'works'])
                ->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                          ->orWhereHas('movements', function ($movementQuery) use ($search) {
                              $movementQuery->where('name', 'like', "%{$search}%");
                          })
                          ->orWhereHas('works', function ($workQuery) use ($search) {
                              $workQuery->where('title', 'like', "%{$search}%");
                          });
                })
                ->paginate(12);
        } else {
            $artists = Artist::with(['movements', 'works'])->paginate(12);
        }

        $artists->getCollection()->transform(function ($artist) {
            $artist->image_url = $artist->image_url;
            return $artist;
        });

        return response()->json([
            'success' => true,
            'data' => $artists
        ]);
    }

    public function show ($artist) {
        if (is_numeric($artist)) {
            $artist = Artist::find($artist);
        } else {
            $artist = Artist::where('slug', $artist)->firstOrFail();
        }
        $artist->load(['movements', 'works']);
        $artist->image_url = $artist->image_url;

        $artist->works->transform(function ($work) {
            $work->image_url = $work->image_url;
            return $work;
        });

        $artist->movements->transform(function ($movement) {
            $movement->image_url = $movement->image_url;
            return $movement;
        });

        return response()->json([
            'success' => true,
            'data' => $artist
        ]);
    }
}
