<?php

namespace Database\Seeders;

use App\Models\Meal;
use Faker\Provider\Lorem;
use Illuminate\Database\Seeder;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //popuni kategorije
        $kategorije=[];
        for($i=1;$i<100;$i++){
            array_push($kategorije,$i);
        }

        // nisam znao kako napraviti da recimo HOT DOG se automatski prevede na francuski jezik...
        //ako koristim 2 faker-a onda drugi naziv dodjeli npr na eng HOT DOG a ovamo WELSH

        $faker = \Faker\Factory::create();
       // $faker2 = \Faker\Factory::create();
        $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));
      //  $faker2->addProvider(new \FakerRestaurant\Provider\fr_FR\Restaurant($faker));

        //popuni jela sa kategorijama
        for($i=1;$i<100;$i++){
            $random_keys=array_rand($kategorije);

            $title= $faker->foodName();
            $description = $faker->text;

            Meal::create([
                'id'=>$i,
                'title_hr' =>$title." -  HR",
                'title_en' =>$title." -  EN",
                'title_fr' =>$title." - FR",
                //'title_fr' =>$faker2->foodName(),
                'description_hr'=>"HR - ".$description,
                'description_en'=>"EN - ".$description,
                'description_fr'=>"FR - ".$description,
                //'description_fr'=>$faker2->text,
                'slug' => "meal-" . ($i) . "",
                'category_id'=>$kategorije[$random_keys]
            ]);
        }
    }
}
