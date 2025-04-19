<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Movement;

class MovementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movementsArray = config('movements');
        foreach ($movementsArray as $movement) {
            $newMovement = new Movement();
            $newMovement->name = $movement['name'];
            $newMovement->description = $movement['description'];
            $newMovement->start_year = $movement['start_year'];
            $newMovement->end_year = $movement['end_year'];
            $newMovement->image = 'movements/' . str_replace([':', ',', '?'], '', str_replace(' ', '_', strtolower($movement['name']))) . '.png';
            $newMovement->save();
            
            $newMovement->artists()->attach($movement['artists']);
        }
    }
}
