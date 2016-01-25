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
Route::get('migrate',function(){
    Artisan::call('migrate:refresh');
});
Route::get('seed',function(){
    Artisan::call('db:seed');
});
Route::post('uploadvk','SocialAuthController@uploadVk');
    Route::group(['middleware' => ['web']], function () {
        Route::get('/', function () {
            // \Illuminate\Support\Facades\Session::push('key','213123');
            return view('welcome');
        });
        Route::get('works','WorksController@generateModelList');
        Route::get('articles','ArticleController@generateModelList');
        Route::get('articles/{id}','ArticleController@viewArticle');
        Route::get('vk', 'SocialAuthController@vkAuth');

        Route::get('/logout',function(){
           session()->flush();
        });
        Route::get('repost/{table}/{id}','SocialAuthController@repost');

    });

Route::group(['middleware' => ['web','customAuth']], function () {
    Route::get('/admin','AdminController@index');
    Route::get('/admin/articles','ArticleController@generateAdminModelList');
    Route::any('/admin/articles/create','ArticleController@create');
    Route::any('/admin/articles/update/{id}','ArticleController@update');
    Route::any('/admin/articles/delete/{id}','ArticleController@delete');

    Route::get('/admin/works','WorksController@generateAdminModelList');
    Route::any('/admin/works/create','WorksController@create');
    Route::any('/admin/works/update/{id}','WorksController@update');
    Route::any('/admin/works/delete/{id}','WorksController@delete');

});