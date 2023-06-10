<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeCategoryVisibility extends Model
{
    use HasFactory;
    protected $table = 'home_categories_visibility';
    public $timestamps = false;

}
