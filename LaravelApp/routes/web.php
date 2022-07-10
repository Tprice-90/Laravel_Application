<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return 'Terry Price';
})->name('contact.show');

Route::get('/fun', function () {
    return 'Laravel makes it easy to develop websites!';
})->name('fun.show');

Route::get('/uid/{id}', function($id) {
    return "ID: $id";
})->where('id', '[0-9]+')->name('uid.show');

Route::group(['as' => 'users.',
    'prefix' => 'users/',
    'where' => ['user' => '[A-Za-z ]+', 'image' => '[0-9]+']], function() {
    Route::get('{user?}', function($user = 'Batman') {
        return "Name: $user";
    })->name('show');

    Route::get('{user}/images/{image}', function($user, $image) {
        return "Name: $user Image: $image";
    })->name('images.show');
});

Route::get('/aboutme', function() {
    $name = ['fullName' => 'Terry Price'];
    return view('pages/about')->with($name);
})->name('aboutme');

Route::get('/thingsiknow', function() {
    $items = ['C#', 'JavaScript', 'PHP', 'HTML'];
    return view('pages/langs', compact('items'));
})->name('thingsiknow');

Route::get('/contact', function() {
    return view('pages/contact', ['email' => 'tp56@myscc.ca']);
})->name('contact');

//Manual Routing - Articles
//Route::get('/articles', 'ArticleController@index')->name('articles.index');
//Route::get('/articles/create', 'ArticleController@create')->name('articles.create');
//Route::post('/articles', 'ArticleController@store')->name('articles.store');
//Route::get('/articles/{article}', 'ArticleController@show')->name('articles.show');
//Route::delete('articles/{article}', 'ArticleController@destroy')->name('articles.destroy');

//Auto Routing - Articles
Route::resource('articles', 'ArticleController', ['except' => ['edit', 'update']]);

//Manual Routing - Categories
//Route::get('/categories/{category}/edit', 'CategoryController@edit')->name('categories.edit');
//Route::put('categories/{category}', 'CategoryController@update')->name('categories.update');
//Route::get('/categories', 'CategoryController@index')->name('categories.index');
//Route::get('/categories/create', 'CategoryController@create')->name('categories.create');
//Route::post('categories', 'CategoryController@store')->name('categories.store');
//Route::get('/categories/{category}', 'CategoryController@show')->name('categories.show');
//Route::delete('categories/{category}', 'CategoryController@destroy')->name('categories.destroy');

//Auto Routing - Categories
Route::get('categories/manage', 'CategoryController@showDeleted')->name('categories.showDeleted');

Route::get('categories/{category}/forceDelete', 'CategoryController@forceDelete')->name('categories.forceDelete');

Route::get('categories/{category}/restore', 'CategoryController@restore')->name('categories.restore');

Route::resource('categories', 'CategoryController');

