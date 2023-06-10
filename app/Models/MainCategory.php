<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    use HasFactory;
    protected $primaryKey = 'name';
    protected $table = 'main_category';
    public $incrementing = false;

    public function sub_category(){
        return $this->hasMany(SubCategories::class,  'main_category_name', 'name');
    }

}
