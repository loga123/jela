<?php

namespace Database\Seeders;

use App\Models\MealTag;
use Illuminate\Database\Seeder;

class MealTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        global $rand_tag;

        //povezi jela i tagove
        $jela=[];
        for($i=1;$i<100;$i++){
            array_push($jela,$i);
        }

        $tagovi=[];
        for($i=1;$i<100;$i++){
            array_push($tagovi,$i);
        }

        for($i=1;$i<98;$i++) {
            //za svako jelo 3 taga
            for ($j = 0; $j < 3; $j++) {
                $rand_tag = array_rand($tagovi);
                while (MealTag::where('meal_id', $jela[$i])->where('tag_id',$tagovi[$rand_tag])->count() > 0) {
                    $rand_tag = array_rand($tagovi);
                }
                MealTag::create([
                    'meal_id' => $jela[$i],
                    'tag_id' => $tagovi[$rand_tag]
                ]);

            }
        }
    }
}
