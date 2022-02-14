<?php

namespace Database\Seeders;

use App\Models\MealIngredient;
use Illuminate\Database\Seeder;

class MealIngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        global $rand_sastojak;


        //povezi jela i sastojke HR
        $jela=[];
        for($i=1;$i<100;$i++){
            array_push($jela,$i);
        }
        $sastojci=[];
        for($i=1;$i<100;$i++){
            array_push($sastojci,$i);
        }


        //prodi kroz  jela i dodijeli im sastojke
        for($i=0;$i<98;$i++) {
            //za svako jelo 3 sastojka
            for ($j = 0; $j < 3; $j++) {
                $rand_sastojak = array_rand($sastojci);
                while (MealIngredient::where('meal_id', $jela[$i])->where('ingredient_id', $sastojci[$rand_sastojak])->count() > 0) {
                    $rand_sastojak = array_rand($sastojci);
                }
                MealIngredient::create([
                    'meal_id' => $jela[$i],
                    'ingredient_id' => $sastojci[$rand_sastojak]
                ]);

            }
        }


    }
}
