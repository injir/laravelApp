<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Illuminate\Support\Facades\Artisan;


    /*
    |--------------------------------------------------------------------------
    | Application Routes
    |--------------------------------------------------------------------------
    |
    | This route group applies the "web" middleware group to every route
    | it contains. The "web" middleware group is defined in your HTTP
    | kernel and includes session state, CSRF protection, and more.
    |
    */

    Route::group(['middleware' => ['web']], function () {
        Route::get('/', function () {
            // \Illuminate\Support\Facades\Session::push('key','213123');
            return view('welcome');
        });
        Route::get('works','WorksController@generateWorksList');
        Route::get('articles','ArticleController@generateArticlesList');
        Route::get('articles/{id}','ArticleController@viewArticle');
        Route::get('vk', 'SocialAuthController@vkAuth');
        Route::get('migrate',function(){
            Artisan::call('migrate:refresh');
        });
        Route::get('/logout',function(){
           session()->flush();
        });
    });

