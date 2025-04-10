<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Work;
use App\Models\Artist;

class Movement extends Model
{
    public function works() {
        return $this->hasMany(Work::class);
    }

    public function artists() {
        return $this->belongsToMany(Artist::class);
    }
}
