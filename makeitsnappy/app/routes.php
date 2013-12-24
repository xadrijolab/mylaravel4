<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'QuestionsController@index');
Route::get('register', 'UsersController@get_new');
Route::get('login', 'UsersController@get_login');
Route::get('logout', 'UsersController@get_logout');
Route::get('question/{id}', 'QuestionsController@get_view');
Route::get('your-questions', array('before'=>'auth', 'uses'=>'QuestionsController@get_your_questions'));
Route::get('question/{id}/edit', array('before'=>'auth', 'uses'=>'QuestionsController@get_edit'));
Route::get('results/{keyword}', 'QuestionsController@get_results');

Route::post('register', array('before'=>'csrf', 'uses'=>'UsersController@post_create'));
Route::post('login', array('before'=>'csrf', 'uses'=>'UsersController@post_login'));
Route::post('ask', array('before'=>array('csrf', 'auth'), 'uses'=>'QuestionsController@post_create'));
Route::post('answer', array('before'=>array('csrf', 'auth'), 'uses'=>'AnswersController@post_create'));
Route::post('search', array('before'=>'csrf', 'uses'=>'QuestionsController@post_search'));

Route::put('question/update', array('before'=>array('csrf', 'auth'), 'uses'=>'QuestionsController@put_update'));