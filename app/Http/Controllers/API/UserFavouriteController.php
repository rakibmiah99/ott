<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserFavouriteController extends Controller
{
    public function __construct()
    {
        $this->path = env('STORAGE_URL');
    }

    function Page(){
        return view('client.component.user_favourite.page');
    }

    function AddOrToFavourite(Request $request){
        $db = DB::table(Table::USER_FAVOURITES);
        $movie_name = $request->movie_name;
        if(!$movie_name){
            return response([
                'status' => false,
                'message' => 'please select a movie'
            ]);
        }
        $user = HelperController::User();
        if(!$user){
            return response([
                'status' => false,
                'message' => 'please login first',
                'redirect_to_login' => true
            ]);
        }

        $has = $db->where('movie_name', $movie_name)->where('user_id', $user->id);
        if($has->count() > 0){
            $res = $has->delete();
            if($res){
                return response([
                    'status' => true,
                    'message' => 'deleted success',
                    'icon' => 'remove'
                ]);
            }
        }
        else{
            $res = $db->insert([
                'user_id' => $user->id,
                'movie_name' => $movie_name
            ]);
            if($res){
                return response([
                    'status' => true,
                    'message' => 'Add to favourite successfully',
                    'icon' => 'add'
                ]);
            }
        }



    }


    function UserWiseFavourite(Request $request){
        $user = HelperController::User();
        $user_favourite =  DB::table(Table::USER_FAVOURITES.' as uf')->
        join(Table::MOVIES.' as m', 'm.name' , '=', 'uf.movie_name')->
        where('user_id',$user->id)->
        get([
            'm.name',
            'm.display_name',
            'm.length',
            'm.description',
            'm.imdb',
            'm.play_mode',
            DB::raw("if(m.tumbnail = '', '', CONCAT('$this->path', m.tumbnail)) as thumbnail"),
        ]);

        return $user_favourite;
    }
}
