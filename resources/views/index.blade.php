@extends('layouts.app')

@section('content')
<div class="loader">
    <img src="{{asset('img/loader_icon.png')}}" alt="#">
</div>
<div class="choose_team d-flex" data-vide-bg="{{ asset('video/video') }}">
    <header class="header d-flex">
        <div class="logo">
            <a href="/"><img src="{{ asset('img/logo.svg') }}" alt="GroupIB"></a>
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
        <h3>Выберите свою команду</h3>
        <ul class="team_list d-flex">
            @foreach($teams as $team)
                <li>
                    <label>
                        <input
                            type="radio"
                            name="team"
                            value="{{$team->id}}"
                            class="visually_hidden">
                        <span class="team_logo">
                            <img
                                src="{{ asset('/') }}img/@if(empty($team->icon))default.svg @else{{$team->icon}}@endif"
                                alt="">
                        </span>
                        <span class="team_name">{{$team->team}}</span>
                    </label>
                </li>
            @endforeach
        </ul>
        <button class="btn btn-blue show-auth-form">{{ trans('interface.start_game') }}</button>
    @endif
    <div class="modal d-flex auth-form">
        <h4 class="modal_heading">{{ trans('interface.title_auth_form') }}</h4>
        <div class="modal_content">
            <div class="modal_content-main">
                <label for="email">
                    <input
                        type="text"
                        id="email"
                        name="email"
                        class="item_content_team item_content-input"
                        placeholder="{{ trans('interface.email') }}"
                        required>
                </label>
                <label for="password">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="item_content_team item_content-input"
                        placeholder="{{ trans('interface.password') }}"
                        required>
                </label>
                <span class="error"></span>
                {{--<label for="remember" class="d-flex">--}}
                    {{--<input--}}
                        {{--type="checkbox"--}}
                        {{--name="remember"--}}
                        {{--id="remember"--}}
                        {{--class="item_content_team item_content-input">--}}
                    {{--{{ trans('interface.remember') }}--}}
                {{--</label>--}}
            </div>
        </div>
        <div class="btns_wrap d-flex">
            {{--<button class="btn btn-blue modal_close">{{ trans('interface.forgot_password') }}</button>--}}
            <button class="btn btn-blue sign-in">{{ trans('interface.sign_in') }}</button>
        </div>

    </div>
</div>
<div class="overlay hidden"></div>
@endsection