<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Work;
use App\Models\Movement;

class Artist extends Model
{
    public function works() {
        return $this->hasMany(Work::class);
    }

    public function movements() {
        return $this->belongsToMany(Movement::class);
    }
}
