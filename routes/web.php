<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;


Route::group(['prefix' => \App\Http\Middleware\LocaleMiddleware::getLocale()], function () {
    Route::resource('/', 'IndexController', [
        'only' => ['index'],
        'names' => [
            'index' => 'home'
        ]
    ]);
});

Route::get('setlocale/{lang}', function ($lang) {
    $referer = Redirect::back()->getTargetUrl();
    $parse_url = parse_url($referer, PHP_URL_PATH);
    $segments = explode('/', $parse_url);

    if (in_array($segments[1], App\Http\Middleware\LocaleMiddleware::$languages)) {
        unset($segments[1]);
    }

    if ($lang != App\Http\Middleware\LocaleMiddleware::$mainLanguage){
        array_splice($segments, 1, 0, $lang);
    }

    $url = Request::root().implode("/", $segments);

    if(parse_url($referer, PHP_URL_QUERY)){
        $url = $url.'?'. parse_url($referer, PHP_URL_QUERY);
    }
    return redirect($url);
})->name('setlocale');

Route::group(['namespace' => 'Auth'], function () {
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout')->name('logout');
    Route::post('/login/user', 'CustomLoginController@loginUser');
});

Route::group(['prefix' => 'user', 'as' => 'user.', 'namespace' => 'User', 'middleware' => 'auth'], function () {
    Route::get('/', 'IndexController@index')->name('index');
    Route::post('/game/save-time', 'GameController@saveTime')->name('save-time');
    Route::post('/game/answer', 'GameController@answer')->name('answer');
    Route::get('/game/result/{team}', 'GameController@result')->name('result');
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

    Route::get('/game/reset-games/{id}', 'GameController@resetGames')->name('reset.games');
});