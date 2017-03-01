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

Route::get('/home', 'HomeController@index');
Route::post('{listing}/contact', 'ListingContactController@store');
Route::get('/welcome', function () {
    return view('welcome');
});
/*
|--------------------------------------------------------------------------
| Message Routes
|--------------------------------------------------------------------------
|
*/

Route::group(['prefix' => 'webapi', 'namespace' => 'Api'], function() {
	Route::get('/conversations', 'ConversationController@index');
	Route::post('/conversations', 'ConversationController@store');
	Route::get('/conversations/{conversation}', 'ConversationController@show');
	Route::post('/conversations/{conversation}/reply', 'ConversationReplyController@store');
	Route::post('/conversations/{conversation}/users', 'ConversationUserController@store');
});
 
Route::get('/conversations', 'ConversationController@index')->name('user.message');
Route::get('/conversations/{conversation}', 'ConversationController@show');

Route::post('/contact', 'ListingContactController@store');
Route::post('/profile', 'UserController@update_avatar');
Route::get('change', 'UserController@change');
Route::post('change', 'UserController@update_avatar');
/*
|--------------------------------------------------------------------------
| Trip Routes
|--------------------------------------------------------------------------
|
*/
Route::get('/search',[ 'uses' => 'SearchController@index', 'middleware' => 'auth']);
Route::get('/trips', 'TripController@index');
Route::get('/trips',['as' => 'home', 'uses' => 'TripController@index', 'middleware' => 'auth' ]);

// show new post form
 Route::get('new-trip','TripController@create');
 // save new post
 Route::post('new-trip','TripController@store');
 // edit post form
 Route::get('edit/{slug}','TripController@edit');
 // update post
 Route::post('update','TripController@update');
 // delete post
 Route::get('delete/{id}','TripController@destroy');
 // display user's all posts
 Route::get('my-all-trips','UserController@user_trips_all');
 // display user's drafts
 Route::get('my-drafts','UserController@user_trips_draft');
 // add comment
 Route::post('comment/add','CommentController@store');
 //users profile
Route::get('user/{id}','UserController@profile')->where('id', '[0-9]+');
// display list of posts
Route::get('user/{id}/trips','UserController@user_trips')->where('id', '[0-9]+');
// display single post
Route::get('/{slug}',['as' => 'trip', 'uses' => 'TripController@show'])->where('slug', '[A-Za-z0-9-_]+');
Route::get('/delete-comment/{comment_id}', [
    'uses' => 'CommentController@destroy',
    'as' => 'comment.delete',
    'middleware' => 'auth'
]);




