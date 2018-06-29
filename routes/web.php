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

// Force to load pages in https in production mode
if (env('APP_ENV') === 'production') {
    URL::forceScheme('https');
}

// RSS feeds
Route::feeds();

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        Auth::routes();

        // Admin first page
        Route::get('/admin', function () {
            return view('admin.index');
        })->middleware('auth')->name('admin');

        // Static pages
        Route::get('/about', function () { return view('public.about'); })->name('about');
        Route::get('/contact', function () { return view('public.contact'); })->name('contact');

        // Public pages
        Route::get('/search', 'HomeController@search')->name('search');
        Route::get('/sport/{slug}', 'HomeController@sport')->name('sport');
        Route::get('/{slug}', 'HomeController@post')->name('post');
        Route::get('/team/{slug}', 'HomeController@team')->name('team');
        Route::get('/tag/{slug}', 'HomeController@tag')->name('tag');
        Route::get('/athlete/{slug}', 'HomeController@athlete')->name('athlete');
        Route::get('/standings/{championship_id}/{season_id}', 'HomeController@standings')->name('standings');
        Route::post('/comment/store', 'HomeController@storeComment')->name('post.comment.store');
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/post/write', 'HomeController@writePost')->name('writePost');


        // If user is admin
        Route::group(['middleware' => 'admin'], function () {
            Route::resource('admin/users', 'AdminUsersController');
            Route::resource('admin/posts', 'AdminPostsController');
            Route::resource('admin/athletes', 'AdminAthletesController');
            Route::resource('admin/stadium', 'AdminStadiumController');
            Route::resource('admin/teams', 'AdminTeamsController');
            Route::resource('admin/sports', 'AdminSportsController');
            Route::resource('admin/seasons', 'AdminSeasonsController');
            Route::resource('admin/rules', 'AdminRulesController');
            Route::resource('admin/matchdays', 'AdminMatchdaysController');
            Route::resource('admin/championships', 'AdminChampionshipsController');
            Route::resource('admin/comments', 'AdminCommentsController');
            Route::patch('admin/comments/{comment}/approvedOrNot', 'AdminCommentsController@approvedOrNot')->name('comments.approvedOrNot');
            Route::resource('admin/matches', 'AdminMatchesController');
            Route::get('admin/matches/create/massive', 'AdminMatchesController@createMassive')->name('matches.create.massive');
            Route::get('admin/standings', 'AdminStandingsController@index')->name('standings.index');

            Route::get('admin/sitemap', 'AdminSitemapGenerator@index')->name('sitemap');
            Route::get('admin/createSitemap', 'AdminSitemapGenerator@run')->name('createSitemap');
        });

    });
