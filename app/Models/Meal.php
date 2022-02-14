<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meal extends Model
{
    use HasFactory,SoftDeletes;

   // protected $translatedAttributes = ['title','description'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $perPage = 20;

    protected $fillable =[
        'title_hr',
        'title_en',
        'title_fr',
        'description_hr',
        'description_en',
        'description_fr',
        'slug',
        'status',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'meal_tags','meal_id','tag_id');
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class,'meal_ingredients','meal_id','ingredient_id');
    }

    public function tagid()
    {
        return $this->hasMany( MealTag::class);
    }
}
