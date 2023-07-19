<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\SubCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\HomeCategory;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->path = env('/');
    }
    //
    function Page(Request $request){
        $category = $request->main;
        return view('client.component.category.category', compact('category'));
    }


    function load(Request $request){
        $main_category =  $request->main;
        $data['all_categories'] = SubCategories::where('main_category_name', $main_category)->
        get()->
        map(function ($item) use ($main_category){
            $new_item['name'] = $item->name;
            $new_item['display_name'] = $item->display_name;
            $movie_query = Movie::where('category_name', $main_category)->where('sub_category_name', $item->name);
            if($movie_query->count('id') > 0){
                $new_item['movies'] = $movie_query->get([
                    'name',
                    'display_name',
                    'length',
                    'description',
                    'imdb',
                    'play_mode',
                    DB::raw("if(tumbnail = '', '', CONCAT('$this->path', tumbnail)) as thumbnail"),
                    DB::raw("if( (select count(id) from user_favourites where user_favourites.movie_name = name and user_favourites.user_id = 1) > 0, 'true', 'false') as favourite")
                ]);
            }
            return $new_item;
        });
        return response($data);
    }

}
