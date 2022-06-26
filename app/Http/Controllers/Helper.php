<?php

namespace App\Http\Controllers;

use App\Models\MyWork;
use Illuminate\Http\Request;

class Helper extends Controller
{
    public static function deleteFile($file){
        if (\File::exists(asset('storage/'.$file))){
            \File::delete(asset('storage/'.$file));
            return true;
        }else{
            return false;
        }
    }
    public static function yearTotalWorks($user_id,$year){
        return MyWork::where([
            ['user_id','=',$user_id],
            ['year','=',$year]
        ])->count();
    }
    public static function monthTotalWorks($user_id,$month){
        return MyWork::where([
            ['user_id','=',$user_id],
            ['month','=',$month]
        ])->count();
    }
}
