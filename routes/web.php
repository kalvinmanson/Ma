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

Route::prefix('admin')->namespace('Admin')->as('admin.')->middleware('auth')->group(function () {
  Route::resource('categories', 'CategoryController');
  Route::resource('blocks', 'BlockController');
  Route::resource('pages', 'PageController');
  Route::resource('fields', 'FieldController');
  Route::resource('users', 'UserController');
  #Route::resource('admin/contacts', 'ContactController');
  //Aulas virtuales
  Route::resource('grades', 'GradeController');
  Route::resource('courses', 'CourseController');

  //personales
	Route::post('pages/duplicate', ['as' => 'pages.duplicate', 'uses' => 'PageController@duplicate']);
});


Route::resource('categories', 'CategoryController');

Route::get('login/google', 'Auth\LoginController@redirectToProvider');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');
Auth::routes();

Route::get('/home', 'WebController@index')->name('home');
Route::get('/admin', function() {
	return redirect()->route('admin.pages.index');
});

Route::get('/', 'WebController@index');
Route::get('/explore', 'WebController@explore');
Route::get('/sitemap.xml', 'WebController@sitemap');

Route::post('/contact', 'ContactController@store');

//aulas virtuales
Route::get('g/{grade}/c/{slug}', 'CourseController@show')->where('grade', '[a-z,0-9-]+')->where('slug', '[a-z,0-9-]+');

//contents
Route::get('g/{grade}/c/{course}/contents', 'ContentController@index')->where('grade', '[a-z,0-9-]+')->where('course', '[a-z,0-9-]+');
Route::post('g/{grade}/c/{course}/contents', 'ContentController@store')->where('grade', '[a-z,0-9-]+')->where('course', '[a-z,0-9-]+');
Route::get('g/{grade}/c/{course}/contents/create', 'ContentController@create')->where('grade', '[a-z,0-9-]+')->where('course', '[a-z,0-9-]+');
Route::get('g/{grade}/c/{course}/contents/{slug}/edit', 'ContentController@edit')->where('grade', '[a-z,0-9-]+')->where('course', '[a-z,0-9-]+')->where('slug', '[a-z,0-9-]+');
Route::post('g/{grade}/c/{course}/contents/{slug}', 'ContentController@update')->where('grade', '[a-z,0-9-]+')->where('course', '[a-z,0-9-]+')->where('slug', '[a-z,0-9-]+');
Route::get('g/{grade}/c/{course}/contents/{slug}', 'ContentController@show')->where('grade', '[a-z,0-9-]+')->where('course', '[a-z,0-9-]+')->where('slug', '[a-z,0-9-]+');

//Activities
Route::middleware('auth')->group(function () {
  Route::post('g/{grade}/c/{course}/activities', 'ActivityController@store')->where('grade', '[a-z,0-9-]+')->where('course', '[a-z,0-9-]+');
  Route::get('g/{grade}/c/{course}/activities/create', 'ActivityController@create')->where('grade', '[a-z,0-9-]+')->where('course', '[a-z,0-9-]+');
  Route::get('g/{grade}/c/{course}/activities/{slug}/edit', 'ActivityController@edit')->where('grade', '[a-z,0-9-]+')->where('course', '[a-z,0-9-]+')->where('slug', '[a-z,0-9-]+');
  Route::post('g/{grade}/c/{course}/activities/{slug}', 'ActivityController@update')->where('grade', '[a-z,0-9-]+')->where('course', '[a-z,0-9-]+')->where('slug', '[a-z,0-9-]+');
  Route::post('g/{grade}/c/{course}/activities/{slug}/answer', 'AnswerController@store')->where('grade', '[a-z,0-9-]+')->where('course', '[a-z,0-9-]+')->where('slug', '[a-z,0-9-]+');
  Route::post('g/{grade}/c/{course}/activities/{slug}/score', 'AnswerController@score')->where('grade', '[a-z,0-9-]+')->where('course', '[a-z,0-9-]+')->where('slug', '[a-z,0-9-]+');
});
Route::get('g/{grade}/c/{course}/activities', 'ActivityController@index')->where('grade', '[a-z,0-9-]+')->where('course', '[a-z,0-9-]+');
Route::get('g/{grade}/c/{course}/activities/{slug}', 'ActivityController@show')->where('grade', '[a-z,0-9-]+')->where('course', '[a-z,0-9-]+')->where('slug', '[a-z,0-9-]+');

//Activities
Route::middleware('auth')->group(function () {
  Route::post('g/{grade}/c/{course}/questions', 'QuestionController@store')->where('grade', '[a-z,0-9-]+')->where('course', '[a-z,0-9-]+');
  Route::get('g/{grade}/c/{course}/questions/create', 'QuestionController@create')->where('grade', '[a-z,0-9-]+')->where('course', '[a-z,0-9-]+');
  Route::get('g/{grade}/c/{course}/questions/{slug}/edit', 'QuestionController@edit')->where('grade', '[a-z,0-9-]+')->where('course', '[a-z,0-9-]+')->where('slug', '[a-z,0-9-]+');
  Route::post('g/{grade}/c/{course}/questions/{slug}', 'QuestionController@update')->where('grade', '[a-z,0-9-]+')->where('course', '[a-z,0-9-]+')->where('slug', '[a-z,0-9-]+');
  Route::post('g/{grade}/c/{course}/questions/{slug}/answer', 'QuestionController@store')->where('grade', '[a-z,0-9-]+')->where('course', '[a-z,0-9-]+')->where('slug', '[a-z,0-9-]+');
  Route::get('g/{grade}/c/{course}/questions', 'QuestionController@index')->where('grade', '[a-z,0-9-]+')->where('course', '[a-z,0-9-]+');
  Route::get('g/{grade}/c/{course}/questions/{slug}', 'QuestionController@show')->where('grade', '[a-z,0-9-]+')->where('course', '[a-z,0-9-]+')->where('slug', '[a-z,0-9-]+');
});


//forum
Route::middleware('auth')->group(function () {
  Route::post('g/{grade}/c/{course}/forum', 'ForumController@store')->where('grade', '[a-z,0-9-]+')->where('course', '[a-z,0-9-]+');
  Route::get('g/{grade}/c/{course}/forum/{slug}/edit', 'ForumController@edit')->where('grade', '[a-z,0-9-]+')->where('course', '[a-z,0-9-]+')->where('slug', '[a-z,0-9-]+');
  Route::post('g/{grade}/c/{course}/forum/{slug}', 'ForumController@update')->where('grade', '[a-z,0-9-]+')->where('course', '[a-z,0-9-]+')->where('slug', '[a-z,0-9-]+');
  Route::post('g/{grade}/c/{course}/forum/{slug}/reply', 'ForumController@reply')->where('grade', '[a-z,0-9-]+')->where('course', '[a-z,0-9-]+')->where('slug', '[a-z,0-9-]+');
});
Route::get('g/{grade}/c/{course}/forum', 'ForumController@index')->where('grade', '[a-z,0-9-]+')->where('course', '[a-z,0-9-]+');
Route::get('g/{grade}/c/{course}/forum/{slug}', 'ForumController@show')->where('grade', '[a-z,0-9-]+')->where('course', '[a-z,0-9-]+')->where('slug', '[a-z,0-9-]+');

// Posts
Route::post('g/{grade}/c/{course}/post', 'PostController@store')->where('grade', '[a-z,0-9-]+')->where('course', '[a-z,0-9-]+')->middleware('auth');

// Votes
Route::post('vote', 'VoteController@store')->middleware('auth');

//mis rutas
Route::get('{category}/{slug}', 'WebController@page')->where('category', '[a-z,0-9-]+')->where('slug', '[a-z,0-9-]+');
Route::get('{slug}', 'WebController@category')->where('slug', '[a-z,0-9-]+');
