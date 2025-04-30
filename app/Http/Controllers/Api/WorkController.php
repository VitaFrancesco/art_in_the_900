<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movement;
use App\Models\Artist;
use App\Models\Work;

class WorkController extends Controller
{
    public function index (Request $request) {
        $data = $request->all();
        $search = $data['search'] ?? '';
        if (array_key_exists('search', $data)) {
            $works = Work::with(['artist', 'movement'])
                ->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhereHas('artist', function ($artistQuery) use ($search) {
                        $artistQuery->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('movement', function ($movementQuery) use ($search) {
                        $movementQuery->where('name', 'like', "%{$search}%");
                    });
        })
        ->paginate(12);
        } else {
            $works = Work::with(['artist', 'movement'])->paginate(12);
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

    public function show ($work) {
        if (is_numeric($work)) {
            $work = Work::find($work);
        } else {
            $work = Work::where('slug', $work)->firstOrFail();
        }
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
