@extends('layouts.app')

@section('content')
<div class="loader">
    <img src="{{asset('img/loader_icon.png')}}" alt="#">
</div>
<div class="choose_team d-flex" data-vide-bg="{{ asset('video/video') }}">
    <header class="header d-flex">
        <div class="logo">
            <img src="{{ asset('img/logo.svg') }}" alt="">
        </div>
        <div class="custom-select">
            <select name="lang" class="lang_select">
                <option value="ru" @if (\App\Http\Middleware\LocaleMiddleware::getLocale() === null) selected @endif>RU</option>
                <option value="en" @if (\App\Http\Middleware\LocaleMiddleware::getLocale() === 'en') selected @endif>EN</option>
            </select>
        </div>
    </header>

    <h1 class="greeting">Добро пожаловать в игру!</h1>
    @if (!empty($teams->toArray()))
        {{ Form::open(['route' => 'game', 'method' => 'get', 'class' => 'teams_wrap']) }}
            <h3>Выберите свою команду</h3>
            <ul class="team_list d-flex">
                @foreach($teams as $team)
                    <li>
                        <label>
                            <input type="radio" name="team" value="{{$team->id}}" class="visually_hidden" @if ('1' === $team->status) disabled @endif>
                            <span class="team_logo">
                                <img src="{{ asset('/') }}img/@if(empty($team->icon))default.svg @else{{$team->icon}}@endif" alt="">
                            </span>
                            <span class="team_name">{{$team->team}}</span>
                        </label>
                    </li>
                @endforeach
            </ul>
            <button class="btn btn-blue">{{ trans('interface.start_game') }}</button>
        {{ Form::close() }}
    @endif
</div>
@endsection