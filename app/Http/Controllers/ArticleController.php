<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

Use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Models\Article as Schema;

class ArticleController extends Controller
{
    const BASIC_ROUTE = '/articles';
    const BASIC_VIEW = 'articles/';
    const BASIC_ADMIN_VIEW = 'admin/articles/';
    const BASIC_ADMIN_ROUTE = 'admin/articles/';
    public function generateModelList(){
        @$model = Schema::all();

        return view(self::BASIC_VIEW.'index',['model'=>@$model]);
    }

    public function generateAdminModelList(){

        @$model = Schema::all();
        return view(self::BASIC_ADMIN_VIEW.'index',['model'=>@$model]);

    }
    public function create(){

        if($_POST){
            $model = new Schema();
            $model->title = $_POST['title'];
            $model->text = $_POST['text'];
            $model->author = Session::get('user.name');
            $model->save();
            return redirect(self::BASIC_ADMIN_ROUTE);
        }
        else {
            return view(self::BASIC_ADMIN_VIEW.'form',['model'=>false]);
        }
    }
    public function update($id){
        $model = Schema::find(@$id);

        if($_POST){

            $model->title = $_POST['title'];
            $model->text = $_POST['text'];
            $model->author = Session::get('user.name');
            $model->save();
            return redirect(self::BASIC_ADMIN_ROUTE);
        }

        return view(self::BASIC_ADMIN_VIEW.'form',['model'=>$model]);
    }


    public function delete($id){
        $article = Schema::find(@$id);
        $article->delete();

        return redirect(self::BASIC_ADMIN_ROUTE);
    }
}
