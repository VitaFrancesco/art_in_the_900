<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Artist;

class ArtistTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $artistsArray = config('movements');
        foreach ($artistsArray as $artist) {
            $newArtist = new Artist();
            $newArtist->name = $artist['name'];
            $newArtist->birth_date = $artist['birth_date'];
            if (array_key_exists('death_date', $artist)) {
                $newArtist->death_date = $artist['death_date'];
            }
            $newArtist->biography = $artist['biography'];
            $newArtist->nationality = $artist['nationality'];
            $newArtist->save();
        }
    }
}
