<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movement;
use App\Models\Artist;
use App\Models\Work;

class MovementController extends Controller
{
    public function index (Request $request) {
        $data = $request->all();
        $search = $data['search'] ?? '';
        if (array_key_exists('search', $data)) {
            $movements = Movement::with(['artists', 'works'])
                ->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhereHas('artists', function ($artistQuery) use ($search) {
                            $artistQuery->where('name', 'like', "%{$search}%");
                        })
                        ->orWhereHas('works', function ($workQuery) use ($search) {
                            $workQuery->where('title', 'like', "%{$search}%");
                        });
                })
                ->paginate(10);
        } else {
            $movements = Movement::with('artists', 'works')->paginate(10);
        }
        
        $movements->getCollection()->transform(function ($movement) {
            $movement->image_url = $movement->image_url;
            return $movement;
        });
        
        return response()->json([
            'success' => true,
            'data' => $movements
        ]);
    }

    public function show (Movement $movement) {
        $movement->load(['artists', 'works']);
        $movement->image_url = $movement->image_url;

        $movement->artists->transform(function ($artist) {
            $artist->image_url = $artist->image_url;
            return $artist;
        });

        $movement->works->transform(function ($work) {
            $work->image_url = $work->image_url;
            return $work;
        });

        return response()->json([
            'success'=> true,
            'data' => $movement
        ]);
    }
    
}
