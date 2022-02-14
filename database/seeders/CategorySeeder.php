<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'kategorija jela na HRV jeziku',
            'category meal in ENG language',
            'categorie un repas en FR',
            'category-'
        ];

        for($i=1;$i<100;$i++){
            Category::create([
                'id'=>$i,
                'title_hr' => "" . ($i) . ". " . $categories[0] . "",
                'title_en' => "" . ($i) . ". " . $categories[1] . "",
                'title_fr' => "" . ($i) . ". " . $categories[2] . "",
                'slug' => "" . $categories[3] . "" . ($i) . ""
            ]);
        }
    }
}
