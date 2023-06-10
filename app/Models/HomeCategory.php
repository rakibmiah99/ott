<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeCategory extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $primaryKey = 'name';
    public $incrementing = false;


    function movies(){
        return $this->hasMany(HomeCategoryVisibility::class, 'home_category_name', 'name');
    }
}
