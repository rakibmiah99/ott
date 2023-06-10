<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
    use HasFactory;
    protected $table = 'sub_category';
    protected $primaryKey = 'name';
    public $timestamps = false;
    public $incrementing = false;

    function category(){
        return $this->belongsTo(MainCategory::class, 'main_category_name', 'name');
    }
}
