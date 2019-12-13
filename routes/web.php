<?php

Route::resource('/', 'IndexController', [
    'only' => ['index'],
    'names' => [
        'index' => 'home'
    ]
]);

Route::get('/game', 'GameController@index')->name('game');
Route::post('/game/save-time', 'GameController@saveTime')->name('save-time');
Route::post('/game/answer', 'GameController@answer')->name('answer');

Route::group(['namespace' => 'Auth'], function () {
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout')->name('logout');
});