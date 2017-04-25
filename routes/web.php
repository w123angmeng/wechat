<?php
use Illuminate\Contracts\Logging\Log;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::match(['get','post'],'/', [
//    'as' => '/', 'uses' => 'Wechat\WechatController@serve'
//]);
//Route::match(['get','post'],'profile', function(){
//    $name = Route::currentRouteName();
//    var_dump($name);
//    exit();
//});
Route::match(['post','get'],'/',['uses' => 'WechatController@serve']);
Route::group(['prefix' => 'profile'], function () {
    Route::match(['post','get'],'index',function(){
        return "这是医院简介！";
    });
    Route::match(['post','get'],'history',function(){
        return "这是医院历史！";
    });
    Route::match(['post','get'],'culture',function(){
        return "这是医院文化！";
    });
    Route::match(['post','get'],'location',function(){
        return "这是地理位置！";
    });
    Route::match(['post','get'],'nav',function(){
        return "这是科室导航！";
    });
});
Route::group(['prefix' => 'server'], function () {
    Route::match(['post','get'],'appointment',function(){
        return "这是预约挂号！";
    });
    Route::match(['post','get'],'inspection_sheet_query',function(){
        return "这是检验单查询！";
    });
    Route::match(['post','get'],'outpatient_records',function(){
        return "这是门诊记录！";
    });
    Route::match(['post','get'],'hospital_records',function(){
        return "这是住院记录！";
    });
});
Route::group(['prefix' => 'member'], function () {
    Route::match(['post','get'],'center',function(){
        return "这是个人中心！";
    });
    Route::match(['post','get'],'faq',function(){
        return "这是常见问题！";
    });
    Route::match(['post','get'],'feedback',function(){
        return "这是意见反馈！";
    });
});

//Route::match(['get','post'],'/', [
//    'as' => '/', 'uses' => 'WechatController@serve'
//]);
//Route::match(['get','post'],'/profile', [
//    'as' => '/profile', 'uses' => 'ProfileController@index'
//]);
//Route::get('profile',function(){
//    return view('welcome');
//});

//Route::match(['get','post'],'profile', function(){
//    return route('profile');
//});
//Route::group(['namespace' => 'Web'], function()
//{
//    /*nav增删改查*/
//    Route::get('/nav', [
//        'as' => 'nav', 'uses' => 'NavController@showNav'
//    ]);
//    Route::match(['get','post'],'/nav/edit/{id}', [
//        'as' => 'nav', 'uses' => 'NavController@editNav'
//    ]);
//    Route::get('/nav/del/{id}', [
//        'as' => 'nav', 'uses' => 'NavController@delNav'
//    ]);
//
//    /*articlecate增删改查*/
//    Route::get('/articlecate', [
//        'as' => 'articlecate', 'uses' => 'ArticleCateController@showArticleCate'
//    ]);
//    Route::match(['get','post'],'/articlecate/edit/{id}', [
//        'as' => 'articlecate', 'uses' => 'ArticleCateController@editArticleCate'
//    ]);
//    Route::get('/articlecate/del/{id}', [
//        'as' => 'articlecate', 'uses' => 'ArticleCateController@delArticleCate'
//    ]);
//
//    /*article增删改查*/
//    Route::get('/article', [
//        'as' => 'article', 'uses' => 'ArticleController@showArticle'
//    ]);
//    Route::match(['get','post'],'/article/edit/{id}', [
//        'as' => 'article', 'uses' => 'ArticleController@editArticle'
//    ]);
//    Route::get('/article/del/{id}', [
//        'as' => 'article', 'uses' => 'ArticleController@delArticle'
//    ]);
//});
