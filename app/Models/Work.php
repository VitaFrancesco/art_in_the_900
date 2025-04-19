<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Artist;
use App\Models\Movement;

class Work extends Model
{
    public function artist () {
        return $this->belongsTo(Artist::class);
    }

    public function movement () {
        return $this->belongsTo(Movement::class);
    }

    public function getImageUrlAttribute() {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}
