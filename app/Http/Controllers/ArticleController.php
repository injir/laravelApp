<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Article;

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
}
