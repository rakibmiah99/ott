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
        $main_category =  $request->main;
        $data = [];
        return $sub_categories = SubCategories::where('main_category_name', $main_category)->
        get()->
        map(function ($item) use ($main_category){
            $new_item['name'] = $item->name;
            $new_item['display_name'] = $item->display_name;
            $new_item['movies'] = Movie::where('category_name', $main_category)->where('sub_category_name', $item->name)->get([
                'name',
                'display_name',
                'length',
                'description',
                'imdb',
                'play_mode',
                DB::raw("if(tumbnail = '', '', CONCAT('$this->path', tumbnail)) as thumbnail"),
                DB::raw("if( (select count(id) from user_favourites where user_favourites.movie_name = name and user_favourites.user_id = 1) > 0, 'true', 'false') as favourite")
            ]);
            return $new_item;
        });

        return Movie::where('category_name', $main_category)->get();


        return view('client.component.category.category');
    }


    function FirstLoad(Request $request){
//        $name = $request->path();
        /*return auth('sanctum')->user();*/
        $feature = DB::table(Table::FEATURE_MOVIES.' as f')->
        join(Table::MOVIES.' as m' ,'f.movie_name', '=', 'm.name')->
        where('m.visibility', '=', 1)->
        get([
            'm.name',
            'm.display_name',
            'm.length',
            'm.description',
            'm.imdb',
            'm.play_mode',
            DB::raw("if(image_1 = '', '', CONCAT('$this->path', m.image_1)) as banner")
        ]);
        $home_movies = [];
        $home_categories =  HomeCategory::orderBy('ordering')->limit(3)->offset(0)->get(['name', 'display_name']);
        foreach($home_categories as $home){
            $home_item ['name'] =   $home->name;
            $home_item ['display_name'] =   $home->display_name;
            $movies = DB::table(Table::MOVIES.' as m')->
            join(Table::HOME_CATEGORIES_VISIBILITY.' as hcv', 'm.name', '=', 'hcv.movie_name')->
            leftJoin('user_favourites as uf', function($query){
                $user_id = 0;
                if(auth('sanctum')->user()){
                    $user_id = auth('sanctum')->user()->id;
                }
                return $query->on('m.name', '=', 'uf.movie_name')->on('uf.user_id', '=', DB::raw("'$user_id'"));
            })->
            where('hcv.home_category_name', '=', $home->name)->
            get([
                'm.name',
                'm.display_name',
                'm.length',
                'm.description',
                'm.imdb',
                'm.play_mode',
                DB::raw("if(m.tumbnail = '', '', CONCAT('$this->path', m.tumbnail)) as thumbnail"),
                DB::raw("if(uf.id != '', 'true', 'false') as favourite")
            ]);

            $home_item ['movies'] = $movies;

            $home_movies [] = $home_item;
        }

//        return $home_movies;
        $data = [
            'feature' => $feature,
            'home_categories' => $home_movies,
        ];
        return response($data);
    }

}
