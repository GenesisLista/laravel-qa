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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/* Resource because it will have CRUD */
Route::resource('questions', 'QuestionsController')->except('show');
//Route::post('/questions/{question}/answers', 'AnswersController@store')->name('answers.store');
Route::resource('questions.answers', 'AnswersController')->only(['store', 'edit', 'update', 'destroy']);
Route::get('/questions/{slug}', 'QuestionsController@show')->name('questions.show');
