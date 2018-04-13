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

// @source for localization https://github.com/mcamara/laravel-localization

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        Auth::routes();

        // Public pages
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/sport/{slug}', 'HomeController@sport')->name('sport');
        Route::get('/post/{slug}', 'HomeController@post')->name('post');
        Route::get('/teamPosts/{slug}', 'HomeController@teamPosts')->name('teamPosts');
        Route::post('/comment/store', 'HomeController@storeComment')->name('post.comment.store');

        // Admin first page
        Route::get('/admin', function () {
            return view('admin.index');
        })->middleware('auth')->name('admin');

        // If user is admin
        Route::group(['middleware' => 'admin'], function () {
            Route::resource('admin/users', 'AdminUsersController');
            Route::resource('admin/posts', 'AdminPostsController');
            Route::resource('admin/athletes', 'AdminAthletesController');
            Route::resource('admin/stadium', 'AdminStadiumController');
            Route::resource('admin/teams', 'AdminTeamsController');
            Route::resource('admin/sports', 'AdminSportsController');
            Route::resource('admin/seasons', 'AdminSeasonsController');
            Route::resource('admin/matchdays', 'AdminMatchdaysController');
            Route::resource('admin/championships', 'AdminChampionshipsController');
            Route::resource('admin/comments', 'AdminCommentsController');
            Route::resource('admin/matches', 'AdminMatchesController');
        });

    });
