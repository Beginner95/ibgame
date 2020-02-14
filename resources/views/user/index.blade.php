@extends('layouts.app')
@section('content')
<div class="loader">
    <img src="{{asset('img/loader_icon.png') }}" alt="#">
</div>
<div class="panel-options">
    <a href="{{ route('logout') }}" class="">Выход</a>
</div>
<div class="date_wrap">
    <div class="date">{{ $time['dateTime']['date'] }}</div>
    <div class="time">{{ $time['dateTime']['hour'] }}:{{ $time['dateTime']['minutes'] }}</div>
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
                    <li  class="{{$class}}"> {{$m->move}} {{ trans('interface.move') }}</li>
                @endforeach
            </ul>
            <div class="training_modal">
                <h4 class="training_heading">{{ trans('training.moves') }}</h4>
                <p>{{ trans('training.moves_description') }}</p>
                <button class="btn btn-gray btn-training">{{ trans('training.next') }}</button>
            </div>

            <div class="timer item_wrap" data-order='3'>
                <span class="timer-hours">{{$time['hour']}}</span>
                :<span class="timer-mins">{{$time['minutes']}}</span>
                :<span class="timer-secs">{{$time['seconds']}}</span>
                <div class="training_modal" style="line-height: 1.15; font-weight: 400; text-align: left; letter-spacing: 0;">
                    <h4 class="training_heading">{{ trans('training.timer') }}</h4>
                    <p>{{ trans('training.timer_description') }}</p>
                    <button class="btn btn-gray btn-training">{{ trans('training.next') }}</button>
                </div>
            </div>
        </header>

        <section class="user_item item item_wrap user_item-descirption" data-order='5'>
            <div class="item_header">
                <h2 class="item_name">{{ trans('interface.task_description') }}</h2>
            </div>
            <div class="item_content">
                {!! $team->description !!}
            </div>
            <div class="training_modal">
                <h4 class="training_heading">{{ trans('training.task_description') }}</h4>
                <p>{{ trans('training.task_all_description') }}</p>
                <button class="btn btn-gray btn-training">{{ trans('training.next') }}</button>
            </div>
        </section>

        <section class="user_item item item_wrap user_item-response" data-order='6'>
            <div class="item_header">
                <h2 class="item_name">{{ trans('interface.your_answer') }}</h2>
            </div>
            @if (empty($move->answer->answer))
                {{ Form::open(['url' => '/user/answer', 'method' => 'post']) }}
                    <input type="hidden" id="team_id" name="team-id" value="{{$team->id}}">
                    <input type="hidden" id="move" name="move-id" data-move="{{ $move->move }}" value="{{$move->id}}">
                    <textarea name="answer" class="item_content item_content-input" required></textarea>
                    <button class="btn btn-blue">{{ trans('interface.reply') }}</button>
                {{ Form::close() }}
            @else
                <div class="item_content item_content-input">{{ $move->answer->answer }}</div>
            @endif
            <div class="training_modal">
                <h4 class="training_heading">{{ trans('training.answer') }}</h4>
                <p>{{ trans('training.answer_description') }}</p>
                <button class="btn btn-gray btn-training">{{ trans('training.reply') }}</button>
            </div>
        </section>

        <aside class="user_item item">
            <div class="item_wrap"  data-order='1'>
                <div class="item_header d-flex">
                    <h2 class="item_name">{{ trans('interface.resources') }}</h2>
                    <div class="item_wrap item_wrap-map"  data-order='2'>
                        <a href="/file/site-map/map.jpg" target="_blank"><button class="btn btn-line">{{ trans('interface.open_network_map') }}</button></a>
                        <div class="training_modal">
                            <h4 class="training_heading">{{ trans('training.network_map') }}</h4>
                            <p>{{ trans('training.network_map_description') }}</p>
                            <img src="/file/site-map/map.jpg" alt="#">
                            <button class="btn btn-gray btn-training">{{ trans('training.next') }}</button>
                        </div>
                    </div>

                </div>
                <div class="item_content">
                    <ul class="resources_list">
                        @foreach ($resources as $resource)
                            <li class="show-modal-resource">{{$resource->resource}}</li>
                            <div class="modal new-info d-flex resource-id" data-name="resource" id="resource={{ $resource->id }}">
                                <h4 class="modal_heading">{{ trans('interface.new_information') }}</h4>
                                <div class="modal_content">
                                    Вы нашли <br>
                                    <div class="modal_content-main d-flex">
                                        @if (!empty($resource->file))
                                            <span><a href="/file/resource/{{ $resource->file }}" target="_blank">{{ trans('interface.file') }}</a></span>
                                        @endif
                                        <span>{{ $resource->resource }}</span>
                                    </div>
                                </div>
                                <button class="btn btn-blue modal_close">{{ trans('interface.accept') }}</button>
                            </div>
                        @endforeach
                    </ul>
                </div>
                <div class="training_modal">
                    <h4 class="training_heading">{{ trans('training.what_are_resources') }}</h4>
                    <p>{{ trans('training.what_are_resources_description') }}</p>
                    <button class="btn btn-gray btn-training">{{ trans('training.next') }}</button>
                </div>
            </div>
            <div class="item_wrap item_wrap-active" data-order='0'>
                <div class="item_header d-flex">
                    <h2 class="item_name">{{ trans('interface.evidences') }}</h2>
                </div>
                <div class="item_content">
                    <ul class="evidence_list">
                        @foreach($team->evidences as $evidence)
                            <li class="show-modal-evidence">{{ $evidence->clue }}</li>
                            <div class="modal new-info d-flex evidence-id" data-name="evidence" id="evidence={{ $evidence->id }}">
                                <h4 class="modal_heading">{{ trans('interface.new_information') }}</h4>
                                <div class="modal_content">
                                    Вы нашли <br>
                                    <div class="modal_content-main d-flex">
                                        @if (!empty($evidence->file))
                                            <span><a href="/file/evidence/{{ $evidence->file }}" target="_blank">{{ trans('interface.file') }}</a></span>
                                        @endif
                                        <span>{{ $evidence->clue }}</span>
                                    </div>
                                </div>
                                <button class="btn btn-blue modal_close">{{ trans('interface.accept') }}</button>
                            </div>
                        @endforeach
                    </ul>
                </div>
                <div class="training_modal">
                    <h4 class="training_heading">{{ trans('training.what_are_evidences') }}</h4>
                    <p>{{ trans('training.what_are_evidences_descriptions') }}</p>
                    <button class="btn btn-gray btn-training">{{ trans('training.next') }}</button>
                </div>
            </div>
            @foreach($team->triggers as $trigger)
                <div class="modal alert d-flex trigger-id" data-name="trigger" id="trigger={{ $trigger->id }}">
                    <h4 class="modal_heading">{{ trans('interface.attention') }}</h4>
                    <div class="modal_content">
                        <div class="modal_content-main d-flex">
                            <span>
                                {{ $trigger->trigger }}
                                @if (!empty($trigger->file))
                                    <a href="/file/trigger/{{ $trigger->file }}" target="_blank">{{ trans('interface.screenshot') }}</a>
                                @endif
                            </span>
                        </div>
                    </div>
                    <button class="btn btn-blue modal_close">{{ trans('interface.accept') }}</button>
                </div>
            @endforeach
        </aside>
    </div>
</div>
<div class="overlay"></div>
<div class="time_alert hidden">{{ trans('interface.one_minute') }}</div>
@endsection