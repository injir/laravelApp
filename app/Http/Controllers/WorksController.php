<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Works as Schema;

class WorksController extends Controller
{
    /**
     *
     */
    const BASIC_ROUTE = 'admin/works/';
    public function generateWorksList(){
        @$works = Works::all();

        return view('works/index',['works'=>@$works]);
    }

    public function generateAdminWorksList(){

        @$model = Schema::all();
        return view('admin/works/index',['model'=>@$model]);

    }
    public function create(){

        if($_POST){
            $model = new Schema();
            $model->title = $_POST['title'];
            $model->text = $_POST['text'];
            $model->author = Session::get('user.name');
            $model->save();
            return redirect(self::BASIC_ROUTE);
        }
        else {
            return view(self::BASIC_ROUTE.'form',['model'=>false]);
        }
    }
    public function update($id){
        $model = Schema::find(@$id);

        if($_POST){

            $model->title = $_POST['title'];
            $model->text = $_POST['text'];
            $model->author = Session::get('user.name');
            $model->save();
            return redirect(self::BASIC_ROUTE);
        }

        return view(self::BASIC_ROUTE.'form',['model'=>$model]);
    }


    public function delete($id){
        $article = Schema::find(@$id);
        $article->delete();

        return redirect(self::BASIC_ROUTE);
    }
}
