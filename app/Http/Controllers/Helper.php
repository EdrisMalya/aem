<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Flysystem\Filesystem;

class Helper extends Controller
{
    public static function deleteFile($file)
    {
        if (\File::exists(asset('storage/' . $file))) {
            \File::delete(asset('storage/' . $file));
            return true;
        } else {
            return false;
        }
    }
}
