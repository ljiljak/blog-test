<?php


Route::get('/posts', 'PostsController@index');
Route::get('/posts/create', 'PostsController@create');
Route::get('/posts/{id}', 'PostsController@show');
Route::post('/posts', 'PostsController@store');

Route::get('/posts/tags/{tag}', 'TagsController@index');

Route::post('/posts/{id}/comment', 'CommentsController@store');

Route::get('/register', 'RegisterController@create');
Route::post('/register', 'RegisterController@store');

Route::get('/login', 'LoginController@create')->name('login');
Route::post('/login', 'LoginController@store');
Route::get('/logout', 'LoginController@destroy');

Route::get('/users/{id}', 'UsersController@show');
