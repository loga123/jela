<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'title_hr',
        'title_en',
        'title_fr',
        'slug'
    ];

    public function meals()
    {
        return $this->hasMany(Meal::class);
    }
}
