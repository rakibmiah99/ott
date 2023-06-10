<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    function query(){


        DB::table('table_name')->count();
        //equivalent to = `SELECT COUNT(*) FROM persons`;

        DB::table('table_name')->count('id');
        //equivalent to = `SELECT COUNT(id) FROM persons`;




    }
}
