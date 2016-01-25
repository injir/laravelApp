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
    const BASIC_ROUTE = '/works';
    const BASIC_VIEW = 'works/';
    const BASIC_ADMIN_VIEW = 'admin/works/';
    const BASIC_ADMIN_ROUTE = 'admin/works/';
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
