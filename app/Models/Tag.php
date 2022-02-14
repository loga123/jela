<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[
        'title_hr',
        'title_en',
        'title_fr',
        'slug'
    ];


    public function meals()
    {
        return $this->belongsToMany(Meal::class,'meal_tags','tag_id','meal_id');
    }
}
