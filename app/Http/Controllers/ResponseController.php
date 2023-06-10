<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResponseController extends Controller
{
    static function Reponse($message, $status = true, $status_code = 200){
        return response([
            'message' => $message,
            'status' => $status
        ], $status_code);
    }
}
