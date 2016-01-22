<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public static function generateMenuItems(){
        $array = Menu::all();
        return $array;
    }
}
