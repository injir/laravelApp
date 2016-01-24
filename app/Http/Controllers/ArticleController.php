<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Article;
Use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class ArticleController extends Controller
{
    public function generateArticlesList(){

         @$articles = Article::all();
        return view('articles/index',['articles'=>@$articles]);

    }
    public function viewArticle($id){
        @$article = Article::find($id);
        return view('articles/article',['article'=>@$article]);
        //var_dump($article);
    }
    public function generateAdminArticlesList(){

        @$articles = Article::all();
        return view('admin/articles/index',['articles'=>@$articles]);

    }

    public function create(){

        if($_POST){
          $article = new Article();
          $article->title = $_POST['title'];
          $article->text = $_POST['text'];
          $article->author = Session::get('user.name');
            $article->save();
            return redirect('/admin/articles');
        }
        else {
            return view('admin/articles/create');
        }
    }
    public function update($id){
        $article = Article::find(@$id);

        if($_POST){

            $article->title = $_POST['title'];
            $article->text = $_POST['text'];
            $article->author = Session::get('user.name');
            $article->save();
            return redirect('/admin/articles');
        }

            return view('admin/articles/create',['article'=>$article]);
    }


    public function delete($id){
        $article = Article::find(@$id);
        $article->delete();

        return redirect('admin/articles');
    }
}
