<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HelperController extends Controller
{
    static public function GenerateToken($request){
        $user_str = json_encode(Auth::guard('admin_auth')->user());
        $token = Crypt::encrypt($user_str);
        $session_key = 'admin_'.Auth::guard('admin_auth')->id();
        $request->session()->put('get_session_key', $session_key);
        $request->session()->put($session_key, $token);
        return $token;
    }

    static public function TokenData($request){
        try {
            $user_data =  Crypt::decrypt($request->bearerToken());
            $user_data = json_decode($user_data);
            $session_key = 'admin_'.$user_data->id;
            if($request->session()->has($session_key)){
                return $user_data;
            }
            else{
                return false;
            }
        }
        catch (\Exception $e){
            return false;
        }
    }

    static public function SessionTokenData($token){
        try {
            $user_data =  Crypt::decrypt($token);
            return $user_data = json_decode($user_data);
        }
        catch (\Exception $e){
            return false;
        }
    }

    static public function Validator($data, $rules){
        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response()->json([
                'success'   => false,
                'message'   => 'Validation errors',
                'errors'      => $validator->errors()
            ],422);
        }

        return true;
    }

    static public function UploadPath($movie_name){
        return "/movies/".date('Y').'/'.$movie_name;
    }

    static function StoragePath(){
        return  env('STORAGE_URL');
    }

    static function User(){
        return auth('sanctum')->user();
    }

    static function ViewerResponse($data,$status_code = 200){
        if(is_array($data)){
           $data ['user'] = auth('sanctum')->user();
           return response($data, $status_code);
        }
        else{
            return response($data, $status_code);
        }
    }


    static function CurrentSubscription($user_id){
        $cs = DB::table(Table::CURRENT_SUBSCRIPTION." as cs")->where('cs.user_id', $user_id)->
        join(Table::SUBSCRIPTION_BUY_HISTORY.' as sbh', 'cs.subscription_history_id','=','sbh.id')->
        get([
            'sbh.subcription_id',
            'sbh.price',
            'sbh.buy_date',
            'sbh.expire_date',
        ]);

        if($cs->isNotEmpty()){
            return $cs->first();
        }
        else{
            return false;
        }

    }

    static function FileUpload($file, $path = null, $prefix = null , $arr = []){
        /*$arr = [
            'size' => '', //optional
            'extensions' => ['jpeg','png'], //optional
        ];
        $file_name = $file->getClientOriginalName();*/

        if(!$file){
            return (object)[
                'status' => true,
                'message' => "uploaded",
                'path' => ''
            ];
        }
        $file_extension =  $file->getClientOriginalExtension();
        $mime = $file->getMimeType();
        $size = $file->getSize();
        if(array_key_exists('size', $arr)){
            if($arr['size'] < $size){
                return (object)[
                    'status' => false,
                    'message' => 'file size is too large'
                ];
            }
        }
        if(array_key_exists('extensions', $arr) && is_array($arr['extensions'])){
            $extensions = $arr['extensions'];
            $match = false;
            foreach ($extensions as $item){
                if($item == $file_extension){
                    $match = true;
                    break;
                }
            }
            if(!$match){
                return (object)[
                    'status' => false,
                    'message' => "file type support only ".implode(',', $extensions)." these type"
                ];
            }
        }

        $destinationPath = 'uploads';
        if($path){
            $destinationPath = $destinationPath.$path;
        }
        $filename = strtotime('now').'.'.$file_extension;
        if ($prefix){
            $filename = $prefix.$filename;
        }
        $file->move($destinationPath, $filename);
        return (object)[
            'status' => true,
            'message' => "uploaded",
            'path' => $destinationPath."/".$filename
        ];

}
}
