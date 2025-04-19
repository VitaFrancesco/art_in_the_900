<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Work;
use App\Models\Artist;
use App\Models\Movement;

class WorkController extends Controller
{
    public function index (Request $request) {
        $data = $request->all();
        $search = $data['search'] ?? '';
        if (array_key_exists('search', $data)) {
            $works = Work::with(['artist', 'movement'])
                ->where($search, function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhereHas('artist', function ($artistQuery) use ($search) {
                        $artistQuery->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('movement', function ($movementQuery) use ($search) {
                        $movementQuery->where('name', 'like', "%{$search}%");
                    });
        })
        ->paginate(10);
        } else {
            $works = Work::with(['artist', 'movement'])->paginate(10);
        }

        $works->getCollection()->transform(function ($work) {
            $work->image_url = $work->image_url;
            return $work;
        });

        return response()->json([
            'success' => true,
            'data' => $works
        ]);
    }

    public function show (Work $work) {
        $work->load(['artist', 'movement']);
        $work->image_url = $work->image_url;
        $work->artist->image_url = $work->artist->image_url;
        $work->movement->image_url = $work->movement->image_url;
        return response()->json([
            'success' => true,
            'data' => $work
        ]);
    }
}
