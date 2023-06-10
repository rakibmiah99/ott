<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use Illuminate\Http\Request;

class MainCategoryController extends Controller
{
    function Page(){
        return view('pages.main_category');
    }
    function GetAll(Request $request){
        return MainCategory::get();
    }
}
