<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Work;

class Museum extends Model
{
    public function works () {
        return $this->hasMany(Work::class);
    }
}
