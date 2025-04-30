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
        $artistsArray = config('artists');
        foreach ($artistsArray as $artist) {
            $newArtist = new Artist();
            $newArtist->name = $artist['name'];
            $newArtist->slug = str_replace(' ', '-', strtolower($artist['name']));
            $newArtist->birth_date = $artist['birth_date'];
            if (array_key_exists('death_date', $artist)) {
                $newArtist->death_date = $artist['death_date'];
            }
            $newArtist->biography = $artist['biography'];
            $newArtist->nationality = $artist['nationality'];
            $newArtist->image = 'artists/' . str_replace([':', ',','?','#','/'], '', str_replace(' ', '_', strtolower($artist['name']))) . '.png';
            $newArtist->save();
        }
    }
}
