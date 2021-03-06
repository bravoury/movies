<?php

// Admin  routes  for movie
Route::group(['prefix' => '/admin/movies'], function () {
    Route::put('news/workflow/{movie}/{step}', 'MovieAdminController@putWorkflow');
    Route::resource('movie', 'MovieAdminController');
});


// User  routes for movie
Route::group(['prefix' => '/user/movies'], function () {
    Route::resource('movie', 'MovieUserController');
});

// Public  routes for movie
Route::group(['prefix' => '/movies'], function () {
    Route::get('news/workflow/{movie}/{step}/{user}', 'MovieController@getWorkflow');
    Route::get('/', 'MoviePublicController@index');
    Route::get('/{slug?}', 'MoviePublicController@show');
});



// Admin  routes  for genre
Route::group(['prefix' => '/admin/movies'], function () {
    Route::put('news/workflow/{genre}/{step}', 'GenreAdminController@putWorkflow');
    Route::resource('genre', 'GenreAdminController');
});


// User  routes for genre
Route::group(['prefix' => '/user/movies'], function () {
    Route::resource('genre', 'GenreUserController');
});

// Public  routes for genre
Route::group(['prefix' => '/movies'], function () {
    Route::get('news/workflow/{genre}/{step}/{user}', 'GenreController@getWorkflow');
    Route::get('/', 'GenrePublicController@index');
    Route::get('/{slug?}', 'GenrePublicController@show');
});


