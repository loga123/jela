<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends Model
{
    use HasFactory,SoftDeletes;

   // public $translatedAttributes = ['title'];



    protected $fillable=[
        'title_hr',
        'title_en',
        'title_fr',
        'slug'
    ];

    public function meals()
    {
        return $this->belongsToMany(Meal::class,'meal_ingredients','ingredient_id','meal_id');
    }
}
