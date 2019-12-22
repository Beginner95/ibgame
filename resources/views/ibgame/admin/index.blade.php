@extends(env('THEME') . '.layouts.head')
<div class="loader">
    <img src="{{asset(env('THEME'))}}/img/loader_icon.png" alt="#">
</div>
<div class="date_wrap">
    <date class="date">03 / 11 / 19</date>
    <date class="time">13:36</date>
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
            <div class="timer">
                <span class="timer-hours">01</span>
                :<span class="timer-mins">01</span>
                :<span class="timer-secs">59</span>
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
            <div>
                <div class="item_header d-flex">
                    <h2 class="item_name">Улики</h2>
                    <button class="add_team add_evidence">+</button>
                </div>
                <div class="item_content">
                    <ul class="evidence_list">
                        @foreach($evidences as $evidence)
                            <li>{{$evidence->clue}}</li>
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
        </aside>
        <button class="btn btn-blue next-step">Следующий ход</button>
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
                        <label>Количество ходов
                            <input type="number" name="moves" value="12" class="item_content_team item_content-input">
                        </label>
                    </div>
                    <div class="mini-input">
                        <label>Время на хода ч:м
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
<div class="modal resource_add_form d-flex">
    {{ Form::open(['route' => 'admin.game.resource', 'method' => 'post', 'files' => true, 'onsubmit' => 'return checkForm(this)'])  }}
    <h4 class="modal_heading">Добавление ресурса</h4>
    <div class="modal_content modal_content-form">
        <div class="add_team_content">
            <label>Имя ресурса
                <input type="text" name="resource" class="item_content_team item_content-input">
            </label>
            <label class="files_wrap d-flex">
                <input type="file" name="file-resource" class='visually_hidden fileMulti'>
                <span class="btn btn-blue">Файл ресурса</span>
            </label>
        </div>
    </div>
    <input type="hidden" name="save-send" value="save">
    <input type="hidden" name="team-id" value="{{$team->id}}">
    <button class="btn btn-blue save_resource" style="float: left;">Сохранить</button>
    <button class="btn btn-blue send_resource">Отправить</button>
    {{ Form::close() }}
</div>
{{--End modal Add Resources--}}
{{--Start modal Add Evidence--}}
<div class="modal evidence_add_form d-flex">
    {{ Form::open(['route' => 'admin.game.evidence', 'method' => 'post', 'files' => true, 'onsubmit' => 'return checkForm(this)'])  }}
    <h4 class="modal_heading">Добавление улики</h4>
    <div class="modal_content modal_content-form">
        <div class="add_team_content">
            <label>Имя ресурса
                <input type="text" name="evidence" class="item_content_team item_content-input">
            </label>
            <label class="files_wrap d-flex">
                <input type="file" name="file-evidence" class='visually_hidden fileMulti'>
                <span class="btn btn-blue">Файл ресурса</span>
            </label>
        </div>
    </div>
    <input type="hidden" name="save-send" value="save">
    <input type="hidden" name="team-id" value="{{$team->id}}">
    <button class="btn btn-blue save_evidence" style="float: left;">Сохранить</button>
    <button class="btn btn-blue send_evidence">Отправить</button>
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
            <label class="files_wrap d-flex">
                <input type="file" name="trigger" class='visually_hidden fileMulti'>
                <span class="btn btn-blue">Приложить файлы</span>
            </label>
            <div class="output_wrap d-flex">
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
@extends(env('THEME') . '.layouts.footer')