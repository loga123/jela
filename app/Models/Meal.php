<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meal extends Model implements TranslatableContract
{
    use HasFactory;
    use SoftDeletes;
    use Translatable;

    protected $hidden=[
        'slug',
        'created_at',
        'updated_at',
        'deleted_at',
        'category_id',
        'translations'
    ];

    protected $translatedAttributes = [
        'title',
        'description'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $perPage = 20;

    protected $fillable =[
        'slug',
        'status',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(
            Category::class
        )->select([
                'id',
                'slug'
            ]);
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'meal_tags',
            'meal_id',
            'tag_id');
    }

    public function ingredients()
    {
        return $this->belongsToMany(
            Ingredient::class,
            'meal_ingredients',
            'meal_id',
            'ingredient_id'
        );
    }

    public function tagid()
    {
        return $this->hasMany(
            MealTag::class
        );
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value;
    }
}
