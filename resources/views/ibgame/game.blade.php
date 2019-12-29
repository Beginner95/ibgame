@extends(env('THEME') . '.layouts.head')

<div class="loader">
    <img src="{{asset(env('THEME'))}}/img/loader_icon.png" alt="#">
</div>
<div class="date_wrap">
    <date class="date">{{ $time['dateTime']['date'] }}</date>
    <date class="time">{{ $time['dateTime']['hour'] }}:{{ $time['dateTime']['minutes'] }}</date>
</div>
<div class="wrap">
    <div class="user_grid center">
        <header class="user_item item d-flex user_item-step item_wrap" data-order='4'>
            <ul class="step_list d-flex">
                @foreach($team->moves as $m)
                    @if ($m->status === '1')
                        @php $class = 'current'; @endphp
                    @elseif ($m->status === '2')
                        @php $class = 'done'; @endphp
                    @else
                        @php $class = ''; @endphp
                    @endif
                    <li  class="{{$class}}"> {{$m->move}} ход</li>
                @endforeach
            </ul>
            <div class="training_modal">
                <h4 class="training_heading">
                    Ходы
                </h4>
                <p>
                    Exercitation esse sint id reprehenderit. Lorem nostrud id aute minim tempor laborum nostrud. Sint aliquip ut Lorem officia mollit ea anim irure qui Lorem ut nisi dolore.
                </p>
                <button class="btn btn-gray btn-training">Дальше</button>
            </div>

            <div class="timer item_wrap" data-order='3'>
                <span class="timer-hours">{{$time['hour']}}</span>
                :<span class="timer-mins">{{$time['minutes']}}</span>
                :<span class="timer-secs">{{$time['seconds']}}</span>
                <div class="training_modal">
                    <h4 class="training_heading">
                        Таймер
                    </h4>
                    <p>
                        Exercitation esse sint id reprehenderit. Lorem nostrud id aute minim tempor laborum nostrud. Sint aliquip ut Lorem officia mollit ea anim irure qui Lorem ut nisi dolore.
                    </p>
                    <button class="btn btn-gray btn-training">Дальше</button>
                </div>
            </div>
        </header>

        <section class="user_item item item_wrap user_item-descirption" data-order='5'>
            <div class="item_header">
                <h2 class="item_name">
                    Описание задачи
                </h2>
            </div>
            <div class="item_content">
                {!! $team->description !!}
            </div>
            <div class="training_modal">
                <h4 class="training_heading">
                    Описание задачи
                </h4>
                <p>
                    Exercitation esse sint id reprehenderit. Lorem nostrud id aute minim tempor laborum nostrud. Sint aliquip ut Lorem officia mollit ea anim irure qui Lorem ut nisi dolore.
                </p>
                <button class="btn btn-gray btn-training">Дальше</button>
            </div>
        </section>

        <section class="user_item item item_wrap user_item-response" data-order='6'>
            <div class="item_header">
                <h2 class="item_name">
                    Ваш ответ
                </h2>
            </div>
            @if (empty($move->answer->answer))
                {{ Form::open(['url' => '/game/answer', 'method' => 'post']) }}
                    <input type="hidden" id="team_id" name="team-id" value="{{$team->id}}">
                    <input type="hidden" id="move" name="move-id" value="{{$move->id}}">
                    <textarea name="answer" class="item_content item_content-input" required></textarea>
                    <button class="btn btn-blue">Отправить</button>
                {{ Form::close() }}
            @else
                <div class="item_content item_content-input">{{ $move->answer->answer }}</div>
            @endif
            <div class="training_modal">
                <h4 class="training_heading">
                    Ответ
                </h4>
                <p>
                    Exercitation esse sint id reprehenderit. Lorem nostrud id aute minim tempor laborum nostrud. Sint aliquip ut Lorem officia mollit ea anim irure qui Lorem ut nisi dolore.
                </p>
                <button class="btn btn-blue btn-training">Ответить</button>
            </div>
        </section>

        <aside class="user_item item">
            <div class="item_wrap"  data-order='1'>
                <div class="item_header d-flex">
                    <h2 class="item_name">
                        Ресурсы
                    </h2>
                    <div class="item_wrap item_wrap-map"  data-order='2'>
                        <button class="btn btn-line show-site-map">
                            Открыть карту сети
                        </button>
                        <div class="training_modal">
                            <h4 class="training_heading">
                                Карта сети
                            </h4>
                            <p>
                                Exercitation esse sint id reprehenderit. Lorem nostrud id aute minim tempor laborum nostrud. Sint aliquip ut Lorem officia mollit ea anim irure qui Lorem ut nisi dolore.
                            </p>
                            <img src="img/info_img.jpg" alt="#">
                            <button class="btn btn-gray btn-training">Дальше</button>
                        </div>
                    </div>

                </div>
                <div class="item_content">
                    <ul class="resources_list">
                        @foreach ($team->resources as $resource)
                            <li class="show-modal-resource">{{$resource->resource}}</li>
                            <div class="modal new-info d-flex resource-id" data-name="resource" id="resource={{ $resource->id }}">
                                <h4 class="modal_heading">Новая информация</h4>
                                <div class="modal_content">
                                    Вы нашли <br>
                                    <div class="modal_content-main d-flex">
                                        @if (!empty($resource->file))
                                            <span><a href="/file/resource/{{ $resource->file }}" target="_blank">Файл</a></span>
                                        @endif
                                        <span>{{ $resource->resource }}</span>
                                    </div>
                                </div>
                                <button class="btn btn-blue modal_close">Принять</button>
                            </div>
                        @endforeach
                    </ul>
                </div>
                <div class="training_modal">
                    <h4 class="training_heading">
                        Что такое ресурсы?
                    </h4>
                    <p>
                        Exercitation esse sint id reprehenderit. Lorem nostrud id aute minim tempor laborum nostrud. Sint aliquip ut Lorem officia mollit ea anim irure qui Lorem ut nisi dolore.
                    </p>
                    <button class="btn btn-gray btn-training">Дальше</button>
                </div>
            </div>
            <div class="item_wrap item_wrap-active" data-order='0'>
                <div class="item_header d-flex">
                    <h2 class="item_name">
                        Улики
                    </h2>
                </div>
                <div class="item_content">
                    <ul class="evidence_list">
                        @foreach($team->evidences as $evidence)
                            <li class="show-modal-evidence">{{ $evidence->clue }}</li>
                            <div class="modal new-info d-flex evidence-id" data-name="evidence" id="evidence={{ $evidence->id }}">
                                <h4 class="modal_heading">Новая информация</h4>
                                <div class="modal_content">
                                    Вы нашли <br>
                                    <div class="modal_content-main d-flex">
                                        @if (!empty($evidence->file))
                                            <span><a href="/file/evidence/{{ $evidence->file }}" target="_blank">Файл</a></span>
                                        @endif
                                        <span>{{ $evidence->clue }}</span>
                                    </div>
                                </div>
                                <button class="btn btn-blue modal_close">Принять</button>
                            </div>
                        @endforeach
                    </ul>
                </div>
                <div class="training_modal">
                    <h4 class="training_heading">
                        Что такое улики?
                    </h4>
                    <p>
                        Exercitation esse sint id reprehenderit. Lorem nostrud id aute minim tempor laborum nostrud. Sint aliquip ut Lorem officia mollit ea anim irure qui Lorem ut nisi dolore.
                    </p>
                    <button class="btn btn-gray btn-training">Дальше</button>
                </div>
            </div>

            <div class="item_wrap" data-order='7'>
                <div class="item_header d-flex">
                    <h2 class="item_name">Триггеры</h2>
                </div>
                <div class="item_content">
                    <ul class="trigger_list">
                        @foreach($team->triggers as $trigger)
                            <li class="show-modal-trigger">{{ $trigger->trigger }}</li>
                            <div class="modal alert d-flex trigger-id" data-name="trigger" id="trigger={{ $trigger->id }}">
                                <h4 class="modal_heading">Внимание!</h4>
                                <div class="modal_content">
                                    <div class="modal_content-main d-flex">
                                        <span>
                                            {{ $trigger->trigger }}
                                            @if (!empty($trigger->file))
                                                <a href="/file/trigger/{{ $trigger->file }}" target="_blank">Скриншот</a>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <button class="btn btn-blue modal_close">Принять</button>
                            </div>
                        @endforeach
                    </ul>
                </div>
                <div class="training_modal">
                    <h4 class="training_heading">
                        Что такое триггеры?
                    </h4>
                    <p>
                        Exercitation esse sint id reprehenderit. Lorem nostrud id aute minim tempor laborum nostrud. Sint aliquip ut Lorem officia mollit ea anim irure qui Lorem ut nisi dolore.
                    </p>
                    <button class="btn btn-gray btn-training">Дальше</button>
                </div>
            </div>
        </aside>
    </div>
</div>
<div class="overlay"></div>
<div class="time_alert hidden">
    У вас осталась 1 минута
</div>
{{--<div class="modal modal-form d-flex">--}}
    {{--<h4 class="modal_heading">--}}
        {{--Добавление триггера--}}
    {{--</h4>--}}
    {{--<div class="modal_content modal_content-form">--}}
        {{--<textarea class="item_content item_content-input"></textarea>--}}
        {{--<label class="files_wrap d-flex">--}}
            {{--<input type="file" multiple="" class='visually_hidden fileMulti'>--}}
            {{--<span class="btn btn-blue">Приложить файлы</span>--}}
        {{--</label>--}}
        {{--<div class="output_wrap d-flex">--}}
            {{--<span>Добавлено:</span>--}}
            {{--<div class="output_files"></div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="btns_wrap d-flex">--}}
        {{--<button class="btn btn-blue modal_close">--}}
            {{--Сохранить--}}
        {{--</button>--}}
        {{--<button class="btn btn-blue modal_close">--}}
            {{--Отправить--}}
        {{--</button>--}}
    {{--</div>--}}
{{--</div>--}}

{{---Start modal site map---}}
<div class="modal modal-site-map d-flex" style="max-width: 800px; max-height: 500px;">
    <div class="modal_content modal_content-form" style="max-width: 725px;">
        <div class="add_team_content">
            <img src="/file/site-map/map.jpg" alt="">
        </div>
    </div>
</div>
{{--End modal site map--}}
<div class="test d-flex center ">
    <div class="heading_wrap">
        <h4 class="modal_heading">
            Временные кнопки для проверки всплывающих окон
        </h4>
    </div>
    <button class="btn btn-blue new_info_show">
        Модалка "Новая информация"
    </button>
    <button class="btn btn-blue alert_show">
        Модалка "Внимание"
    </button>
    <button class="btn btn-blue time_show">
        Модалка "Осталась 1 минута"
    </button>
    <button class="btn btn-blue form_show">
        Модалка "Добавление триггера"
    </button>
</div>

@extends(env('THEME') . '.layouts.footer')