<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingradients = [
            'sastojak jela na HRV jeziku',
            'ingradient meal in ENG language',
            'ingradient un repas en FR',
            'ingradient-'
        ];

        for($i=1;$i<100;$i++){
            Ingredient::create([
                'id'=>$i,
                'title_hr' => "" . ($i) . ". " . $ingradients[0] . "",
                'title_en' => "" . ($i) . ". " . $ingradients[1] . "",
                'title_fr' => "" . ($i) . ". " . $ingradients[2] . "",
                'slug' => "" . $ingradients[3] . "" . ($i) . ""
            ]);

        }
    }
}
