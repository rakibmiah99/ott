<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
class SearchController extends Controller
{

    public function __construct()
    {
        $this->path = env('STORAGE_URL');
    }

    const movies_for_search_view = 'movies_for_search';
    function Search(Request $request){
        $movie = $request->get('movie');
        if ($movie==""){
            return [];
        }
        $result = DB::table(self::movies_for_search_view)->
        where('display_name', 'like', '%'.$movie.'%')->limit(10)->
        get([
            'movies_name',
            'name',
            'display_name',
            DB::raw("if(tumbnail = '', '', CONCAT('$this->path', tumbnail)) as thumbnail"),
            'play_mode',
            'length',
            'video_type_name',
        ]);

        // insert search text
        $text = array();
        $text['text'] = $movie;
        $text['ip'] = $request->ip();
        if (Auth::guard('admin_auth')->user()) {
            $text['user_id'] = Auth::guard('admin_auth')->user()->id;
        }
        DB::table('searchs')->insert($text);
        return $result;
    }

   
}
