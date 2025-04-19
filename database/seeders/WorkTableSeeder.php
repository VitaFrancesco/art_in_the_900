<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Work;

class WorkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $worksArray = config('works');
        foreach ($worksArray as $work) {
            $newWork = new Work();
            $newWork->title = $work['title'];
            $newWork->museum = $work['museum'];
            $newWork->description = $work['description'];
            $newWork->creation_year = $work['creation_year'];
            $newWork->technique = $work['technique'];
            $newWork->width = $work['width'];
            $newWork->height = $work['height'];
            $newWork->artist_id = $work['artist_id'];
            $newWork->movement_id = $work['movement_id'];
            $newWork->image = 'works/' . str_replace([':', ',', '?'], '', str_replace(' ', '_', strtolower($work['title']))) . '.png';
            $newWork->save();
        }
    }
}
