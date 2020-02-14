@extends('admin.layouts.app')

@section('content')
<div class="loader">
    <img src="{{asset(env('THEME'))}}/img/loader_icon.png" alt="#">
</div>
<div class="panel-options">
    <a href="{{ route('admin.reset.games', [2048]) }}" class="">Сброс игры</a>
    <a href="{{ route('logout') }}" class="">Выход</a>
</div>
<div class="date_wrap">
    <div class="date">{{ $time['dateTime']['date'] }}</div>
    <div class="time">{{ $time['dateTime']['hour'] }}:{{ $time['dateTime']['minutes'] }}</div>
</div>
<div class="wrap">
    <div class="admin_grid center">
        <header class="admin_item item d-flex admin-header">
            <ul class="team_list d-flex">
                @foreach ($teams as $t)
                    <li>
                        <label @if ($t->id === $team->id) class="active" @endif>
                            <input type="radio"  checked="" name="team" value="{{$t->id}}" class="team_selector visually_hidden">
                            <span class="team_logo">
                                <img src="{{asset(env('THEME'))}}/img/@if(empty($t->icon))default.svg @else{{$t->icon}} @endif" alt="">
                            </span>
                            <span class="team_name">{{$t->team}}</span>
                        </label>
                    </li>
                @endforeach

                <li>
                    <button class="add_team add_team_and_game">+</button>
                </li>
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
        </header>

        <section class="admin_item item admin_item-main d-flex">
            <div class="admin_item-main-block">
                <div class="item_header">
                    <h2 class="item_name">
                        Описание задачи
                    </h2>
                </div>
                <div class="item_content">
                    {!! $team->description !!}
                </div>
            </div>
            <div class="admin_item-main-block">
                <div class="item_header">
                    <h2 class="item_name">
                        Ответ команды
                    </h2>
                </div>
                <div class="item_content">
                    <p>
                        @if (!empty($answer))
                            {{$answer->answer}}
                        @endif
                    </p>
                </div>
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

        <section class="admin_item item admin_item-variants">
            <div class="item_header item_header-variants d-flex">
                <h2 class="item_name">Варианты развития событий</h2>
                <button class="add_team add_event_option">+</button>
            </div>
            <div class="variants_grid">
                @foreach ($eventOptions as $eventOption)
                    @php $style = ''; @endphp
                    @foreach($team->eventOptions as $option)
                        @if ($option->id === $eventOption->id)
                            @php $style = 'style=display:none;'; @endphp
                        @endif
                    @endforeach
                    <div class="variant_item">
                        <h3 class="variant_name">{{$eventOption->name}}</h3>
                        <button id="{{ $eventOption->id }}" class="variant_edit" {{$style}}></button>
                        <a href="{{ route('admin.event.option.destroy', [$eventOption->id]) }}" class="variant_delete"></a>
                        <div class="variant_text">{{$eventOption->description}}</div>
                    </div>
                @endforeach
            </div>

            <div class="training_modal">
                <h4 class="training_heading">
                    Ответ
                </h4>
                <p>
                    Exercitation esse sint id reprehenderit. Lorem nostrud id aute minim tempor laborum nostrud. Sint aliquip ut Lorem officia mollit ea anim irure qui Lorem ut nisi dolore.
                </p>
                <button class="btn btn-blue btn-training">Начать игру</button>
            </div>
        </section>

        <aside class="admin_item item">
            <div >
                <div class="item_header d-flex">
                    <h2 class="item_name">Ресурсы</h2>
                    <button class="add_team add_resource">+</button>
                </div>
                <div class="item_content">
                    <ul class="resources_list">
                        @foreach ($resources as $resource)
                            <li data-resource-id="{{ $resource->id }}" data-resource-file="{{ $resource->file }}">{{$resource->resource}}</li>
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
            <div>
                <div class="item_header d-flex">
                    <h2 class="item_name">Улики</h2>
                    <button class="add_team add_evidence">+</button>
                </div>
                <div class="item_content">
                    <ul class="evidence_list">
                        @foreach($evidences as $evidence)
                            @php $status = 'data-exist-evidence=0'; @endphp
                            @foreach($team->evidences as $e)
                                @if ($e->id === $evidence->id)
                                    @php $status = 'data-exist-evidence=1'; @endphp
                                @endif
                            @endforeach
                            <li data-evidence-id="{{ $evidence->id }}" data-evidence-file="{{ $evidence->file }}" data-evidence-percent="{{ $evidence->percent }}" {{$status}}>{{$evidence->clue}}</li>
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
            <div>
                <div class="item_header d-flex">
                    <h2 class="item_name">Триггеры</h2>
                    <button class="add_team add_trigger">+</button>
                </div>
                <div class="item_content">
                    <ul class="trigger_list">
                        @foreach($triggers as $trigger)
                            @php $status = 'data-exist-trigger=0'; @endphp
                            @foreach($team->triggers as $t)
                                @if ($t->id === $trigger->id)
                                    @php $status = 'data-exist-trigger=1'; @endphp
                                @endif
                            @endforeach
                            <li data-trigger-id="{{ $trigger->id }}" data-trigger-file="{{ $trigger->file }}" {{$status}}>{{$trigger->trigger}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div>
                <div class="item_header d-flex">
                    <h2 class="item_name">Карта сети</h2>
                    <button class="add_team add_site_map">+</button>
                </div>
                <div class="item_content">
                    @if (file_exists(public_path('file/site-map/map.jpg')))
                        <a href="/file/site-map/map.jpg" target="_blank">Просмотреть</a>
                    @endif
                </div>
            </div>
        </aside>
        @if (!empty($move))
            {{ Form::open(['route' => 'admin.next.move', 'method' => 'post']) }}
                <input type="hidden" name="move-id" value="{{ $move->id }}">
                <input type="hidden" name="team-id" value="{{ $team->id }}">
                @if (!empty($answer))
                    <button class="btn btn-blue next-step">@if ($move->status_game === 'game_over') Завершить игру @else Следующий ход @endif</button>
                @endif
            {{ Form::close() }}
        @endif
    </div>
</div>
<div class="overlay hidden"></div>
<div class="modal new-info d-flex">
    <h4 class="modal_heading">
        Новая информация
    </h4>
    <div class="modal_content">
        Вы нашли <br>
        <div class="modal_content-main d-flex">
				<span>
					<img src="{{asset(env('THEME'))}}/img/modal_img.png" alt="#">
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

{{--Start modal add Team--}}
<div class="modal team_add_form d-flex" style="min-height: 600px;">
    {{ Form::open(['route' => 'admin.game.store', 'method' => 'post', 'files' => true, 'onsubmit' => 'return checkForm(this)']) }}
        <h4 class="modal_heading">Добавление команды</h4>
        <div class="modal_content modal_content-form">
            <div class="add_team_content">
                <label>Имя команды
                    <input type="text" name="name" class="item_content_team item_content-input">
                </label>
                <div class="inputs">
                    <div class="mini-input">
                        <label>E-mail
                            <input type="text" name="email" class="item_content_team item_content-input">
                        </label>
                    </div>
                    <div class="mini-input">
                        <label>Пароль
                            <input type="password" name="password" class="item_content_team item_content-input">
                        </label>
                    </div>
                </div>
                <div class="inputs">
                    <div class="mini-input">
                        <label>Количество ходов
                            <input type="number" name="moves" value="12" class="item_content_team item_content-input">
                        </label>
                    </div>
                    <div class="mini-input">
                        <label>Время на ход ч:м
                            <input type="time" name="time" value="00:10" class="item_content_team item_content-input">
                        </label>
                    </div>
                </div>
                <label>Описание задачи
                    <textarea name="description" class="item_content item_content-input"></textarea>
                </label>
                <label class="files_wrap d-flex">
                    <input type="file" name="icon" class='visually_hidden fileMulti'>
                    <span class="btn btn-blue">Иконка команды</span>
                </label>
                <div class="output_wrap d-flex">
                    <span>Добавлено:</span>
                    <div class="output_files"></div>
                </div>
            </div>
        </div>
        <button class="btn btn-blue team_modal_close">Добавить</button>
    {{ Form::close() }}
</div>
{{--End modal add Team--}}
{{--Start modal Add Resources--}}
<div class="modal modal-form resource_add_form d-flex">
    {{ Form::open(['route' => 'admin.add.resource', 'method' => 'post', 'files' => true, 'onsubmit' => 'return checkForm(this)'])  }}
    <h4 class="modal_heading">Добавление ресурса</h4>
    <div class="modal_content modal_content-form">
        <div class="add_team_content">
            <textarea name="resource-name" class="item_content item_content-input"></textarea>
            <label class="files_wrap d-flex" data-id="resource">
                <input type="file" name="resource" class='visually_hidden resource'>
                <span class="btn btn-blue file-resource">Приложить файлы</span>
            </label>
            <div class="output_wrap resource d-flex">
                <span>Добавлено:</span>
                <div class="output_files"></div>
            </div>
        </div>
    </div>
    <input type="hidden" name="resource-id" value="">
    <div class="btns_wrap d-flex">
        <button class="btn btn-blue save_resource">Сохранить</button>
    </div>
    {{ Form::close() }}
</div>
{{--End modal Add Resources--}}
{{--Start modal Add Evidence--}}
<div class="modal modal-form evidence_add_form d-flex">
    {{ Form::open(['route' => 'admin.add.evidence', 'method' => 'post', 'files' => true, 'onsubmit' => 'return checkForm(this)'])  }}
    <h4 class="modal_heading">Добавление улики</h4>
    <div class="modal_content modal_content-form">
        <div class="add_team_content">
            <textarea name="evidence-name" class="item_content item_content-input"></textarea>
            <input type="text" name="percent" class="item_content_team item_content-input" style="margin: 2px 0;" placeholder="Процент улики">
            <label class="files_wrap d-flex" data-id="evidence">
                <input type="file" name="evidence" class='visually_hidden evidence'>
                <span class="btn btn-blue file-evidence">Приложить файлы</span>
            </label>
            <div class="output_wrap evidence d-flex">
                <span>Добавлено:</span>
                <div class="output_files"></div>
            </div>
        </div>
    </div>
    <input type="hidden" name="evidence-id" value="">
    <div class="btns_wrap d-flex">
        <button class="btn btn-blue save_evidence">Сохранить</button>
        <button class="btn btn-blue send_evidence">Отправить</button>
        <input type="hidden" name="team-id" value="{{$team->id}}"><input type="hidden" name="save-send" value="save">
    </div>
    {{ Form::close() }}
</div>
{{--End modal Add Evidence--}}
{{--Start modal Add Trigger--}}
<div class="modal modal-form trigger_add_form d-flex">
    {{ Form::open(['route' => 'admin.add.trigger', 'method' => 'post', 'files' => true, 'onsubmit' => 'return checkForm(this)'])  }}
    <h4 class="modal_heading">Добавление триггера</h4>
    <div class="modal_content modal_content-form">
        <div class="add_team_content">
            <textarea name="trigger-name" class="item_content item_content-input"></textarea>
            <label class="files_wrap d-flex" data-id="trigger">
                <input type="file" name="trigger" class='visually_hidden fileMulti trigger'>
                <span class="btn btn-blue file-trigger">Приложить файлы</span>
            </label>
            <div class="output_wrap trigger d-flex">
                <span>Добавлено:</span>
                <div class="output_files"></div>
            </div>
        </div>
    </div>
    <input type="hidden" name="trigger-id" value="">
    <div class="btns_wrap d-flex">
        <button class="btn btn-blue save_trigger">Сохранить</button>
        <button class="btn btn-blue send_trigger">Отправить</button>
        <input type="hidden" name="team-id" value="{{$team->id}}"><input type="hidden" name="save-send" value="save">
    </div>
    {{ Form::close() }}
</div>
{{--End modal Add Trigger--}}
{{--Start modal Add Event option--}}
<div class="modal event_option_add_form d-flex">
    {{ Form::open(['route' => 'admin.event.option', 'method' => 'post', 'onsubmit' => 'return checkForm(this)'])  }}
    <h4 class="modal_heading">Добавление варианта развития события</h4>
    <label>Имя варианта
        <input type="text" name="name-event-option" class="item_content_team item_content-input">
    </label>
    <input type="hidden" name="save-send" value="save">
    <input type="hidden" name="team-id" value="{{$team->id}}">
    <input type="hidden" name="event-option-id" value="">
    <div class="modal_content">
        <label>Описание варианта
            <textarea name="description-event-option" class="item_content item_content-input" style="height: 100px;"></textarea>
        </label>
    </div>
    <button class="btn btn-blue save_event_option" style="float: left;">Сохранить</button>
    <button class="btn btn-blue send_event_option" style="float: right;">Отправить</button>
    {{ Form::close() }}
</div>
{{--End modal Add Event option--}}
{{--Start modal Add site map--}}
<div class="modal modal-form add_site_map_form d-flex">
    {{ Form::open(['route' => 'admin.add.site.map', 'method' => 'post', 'files' => true, 'onsubmit' => 'return checkForm(this)'])  }}
    <h4 class="modal_heading">Добавление карты сети</h4>
    <div class="modal_content modal_content-form">
        <div class="add_team_content">
            <label class="files_wrap d-flex" data-id="trigger">
                <input type="file" name="site-map" class='visually_hidden fileMulti trigger'>
                <span class="btn btn-blue file-trigger">Приложить файлы</span>
            </label>
            <div class="output_wrap trigger d-flex">
                <span>Добавлено:</span>
                <div class="output_files"></div>
            </div>
        </div>
    </div>
    <div class="btns_wrap d-flex">
        <button class="btn btn-blue save_site_map" style="margin: 0 auto;">Сохранить</button>
    </div>
    {{ Form::close() }}
</div>
{{--End modal Add site map--}}
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

<div class="time_alert hidden">
    У вас осталась 1 минута
</div>
@endsection