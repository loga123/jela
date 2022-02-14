<?php

namespace Database\Seeders;

use App\Models\Tag;
use Faker\Provider\Address;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $tags = [
            'tag jela na HRV jeziku',
            'tag meal in ENG language',
            'tag un repas en FR',
            'tag-'
        ];
        $counter=1;
        for($i=1;$i<100;$i++){
            Tag::create([
                'id'=>$i,
                'title_hr' => "" . ($i) . ". " . $tags[0] . "",
                'title_en' => "" . ($i) . ". " . $tags[1] . "",
                'title_fr' => "" . ($i) . ". " . $tags[2] . "",
                'slug' => "" . $tags[3] . "" . ($i) . ""
            ]);
            $counter++;
        }




    }
}
