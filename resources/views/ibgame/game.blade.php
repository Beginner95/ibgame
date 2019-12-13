@extends(env('THEME') . '.layouts.head')

<div class="loader">
    <img src="img/loader_icon.png" alt="#">
</div>
<div class="date_wrap">
    <date class="date">03 / 11 / 19</date>
    <date class="time">13:36</date>
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
            {{ Form::open(['url' => '/game/answer', 'method' => 'post']) }}
                <input type="hidden" id="team_id" name="team-id" value="{{$team->id}}">
                <input type="hidden" id="move_id" name="move-id" value="{{$move->id}}">
                <textarea name="answer" class="item_content item_content-input" required></textarea>
                <button class="btn btn-blue">Отправить</button>
            {{ Form::close() }}
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
                        <button class="btn btn-line">
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
                            <li>{{$resource->resource}}</li>
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
                        @foreach($team->evidence as $evidendce)
                            <li>{{$evidendce->clue}}</li>
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
        </aside>
    </div>
</div>
<div class="overlay"></div>
<div class="modal new-info d-flex">
    <h4 class="modal_heading">
        Новая информация
    </h4>
    <div class="modal_content">
        Вы нашли <br>
        <div class="modal_content-main d-flex">
				<span>
					<img src="img/modal_img.png" alt="#">
				</span>
            <span>
					КОПИЮ ПАСПОРТА
				</span>
        </div>
    </div>
    <button class="btn btn-blue modal_close">
        Принять
    </button>
</div>
<div class="modal alert d-flex">
    <h4 class="modal_heading">
        Внимание!
    </h4>
    <div class="modal_content">
        <div class="modal_content-main d-flex">
				<span>
					Threat Intelligence отправил <a href="#">скриншот</a>
				</span>
        </div>
    </div>
    <button class="btn btn-blue modal_close">
        Принять
    </button>
</div>
<div class="time_alert hidden">
    У вас осталась 1 минута
</div>
<div class="modal modal-form d-flex">
    <h4 class="modal_heading">
        Добавление триггера
    </h4>
    <div class="modal_content modal_content-form">
        <textarea class="item_content item_content-input"></textarea>
        <label class="files_wrap d-flex">
            <input type="file" multiple="" class='visually_hidden fileMulti'>
            <span class="btn btn-blue">Приложить файлы</span>
        </label>
        <div class="output_wrap d-flex">
            <span>Добавлено:</span>
            <div class="output_files"></div>
        </div>
    </div>
    <div class="btns_wrap d-flex">
        <button class="btn btn-blue modal_close">
            Сохранить
        </button>
        <button class="btn btn-blue modal_close">
            Отправить
        </button>
    </div>
</div>
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