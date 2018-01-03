<?php

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


//static-pages 路由
Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');

Route::get('signup', 'UsersController@create')->name('signup');//URI看来，/signup 和signup是一样
Route::resource('users', 'UsersController');
//route about session
Route::get('login', 'SessionController@create')->name('login');
Route::post('login', 'SessionController@store')->name('login');
Route::delete('logout', 'SessionController@destroy')->name('logout');
//confirm email
Route::get('signup/confrim/{token}', 'UsersController@confirmEmail')->name('confirm_email');
//Laravel自带的重置密码
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
//自己写的测试发送邮件
Route::get('/sendEmail', 'MailController@send');
//创建删除 ，增加的路由
Route::resource('statuses', 'StatusesController', ['only'=>['store', 'destroy']]);
//对用户关注进行显示
Route::get('users/{user}/followings', 'UsersController@followings')->name('users.followings');
Route::get('users/{user}/followers', 'UsersController@followers')->name('users.followers');
//关注用户， 取消用户
Route::post('users/followers/{user}', 'FollowersController@store')->name('followers.store');
Route::delete('users/followers/{user}', 'FollowersController@destroy')->name('followers.destroy');