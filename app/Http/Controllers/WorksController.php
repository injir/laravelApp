<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Works;

class WorksController extends Controller
{
    /**
     *
     */
    public function generateWorksList(){
        @$works = Works::all();

        return view('works/index',['works'=>@$works]);
    }
}
