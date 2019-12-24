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

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => 'auth'], function() {
    Route::get('/', 'IndexController@index')->name('index');
    Route::resource('/game', 'GameController');

    Route::post('/game/site-map', 'GameController@siteMap')->name('add.site.map');
    Route::post('/game/next-move', 'GameController@nextMove')->name('next.move');

    Route::post('/resource', 'ResourceController@store')->name('add.resource');
    Route::get('/resource/destroy/{id}', 'ResourceController@destroy')->name('resource.destroy');

    Route::post('/evidence', 'EvidenceController@store')->name('add.evidence');
    Route::get('/evidence/destroy/{id}', 'EvidenceController@destroy')->name('evidence.destroy');

    Route::post('/trigger', 'TriggerController@store')->name('add.trigger');
    Route::get('/trigger/destroy/{id}', 'TriggerController@destroy')->name('trigger.destroy');

    Route::post('/event-option', 'EventOptionController@store')->name('event.option');
    Route::get('/event-option/destroy/{id}', 'EventOptionController@destroy')->name('event.option.destroy');
});