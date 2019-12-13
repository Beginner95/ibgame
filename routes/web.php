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