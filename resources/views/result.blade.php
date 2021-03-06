@extends('layouts.app')
@section('content')
<div class="loader">
    <img src="{{asset('img/loader_icon.png')}}" alt="#">
</div>
<div class="choose_team d-flex"  style="background: #030919;">
    <header class="header d-flex">
        <div class="logo">
            <a href="https://www.group-ib.ru/"><img src="{{ asset('img/logo.svg') }}" alt="GroupIB"></a>
        </div>
        <div class="custom-select">
            <select name="lang" class="lang_select">
                <option value="ru" @if (\App\Http\Middleware\LocaleMiddleware::getLocale() === null) selected @endif>RU</option>
                <option value="en" @if (\App\Http\Middleware\LocaleMiddleware::getLocale() === 'en') selected @endif>EN</option>
            </select>
        </div>
    </header>
    <h1 class="greeting">Ваш результат за игру</h1>
    <div class="circle_wrap">
        <svg class='circle' width='500' height='500'>
            <circle class='' cx='250' cy='250'  r='161' stroke-width='30' stroke='#20242B' fill='transparent'/>
            <circle  class='circle_progress' cx='250' cy='250'  r='161' stroke-width='32' stroke='#004CDF' fill='transparent'/>
            <circle  class='progressIndicator' cx='250' cy='250'  r='185' stroke-width='4' stroke='#fff' fill='transparent' stroke-dasharray='1 52'/>
        </svg>
        <div class="result_counter">
            0%
        </div>
        <input type="hidden" class='result_value' value="{{ $percent }}">
    </div>
    <div class="show-answer-status">
        @if ($percent <= 30)
            {{ trans('result.p30') }}
        @elseif ($percent >= 40 && $percent <= 50)
            {{ trans('result.p40-50') }}
        @elseif ($percent >= 60 && $percent <= 70)
            {{ trans('result.p60-70') }}
        @elseif ($percent >= 80 && $percent <= 90)
            {{ trans('result.p80-90') }}
        @else
            {{ trans('result.p100') }}
        @endif
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
    var resultTimeout = setTimeout(function() {
        resultAnimation()
    }, 3000);

</script>
@endsection