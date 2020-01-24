<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Move;
use App\Resource;
use App\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(Request $request)
    {
        $team_id = $request['team'];
        if (empty($team_id)) return back();
        $team = Team::where('id', $team_id)->first();
        $move = Move::where('team_id', $team_id)->where('status', 1)->first();

        if (empty($move)) {
            $move = Move::where('team_id', $team_id)->where('status', 2)->latest('move')->first();
        }

        $time = [
            'hour' => Carbon::parse($move->play_time)->format('H'),
            'minutes' => Carbon::parse($move->play_time)->format('i'),
            'seconds' => Carbon::parse($move->play_time)->format('s'),
            'dateTime' => [
                'date' => Carbon::parse($move->play_time_start)->format('d/m/y'),
                'hour' => Carbon::parse($move->play_time_start)->format('H'),
                'minutes' => Carbon::parse($move->play_time_start)->format('i')
            ]
        ];

        if('0' === $team->status) {
            $this->edit($team_id);
        }

        if ((!isset($_COOKIE['game'])) || $_COOKIE['game'] !== 'running' && '1' === $team->status) {
            return redirect('/');
        }

        return view('game', [
            'team' => $team,
            'time' => $time,
            'move' => $move,
            'resources' => Resource::get()
        ]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        setcookie('game', 'running', 0);
        Team::where('id', $id)->update(['status' => 1]);
        return $_COOKIE['game'] = 'running';
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function saveTime(Request $request)
    {
        $move = $request['move'];
        $time = $request['hour'] . ':' . $request['minutes'] . ':' . $request['seconds'];
        $playTime = Carbon::parse($time)->format('H:i:s');
        Move::where('move', $move)->update(['play_time' => $playTime]);
    }

    public function answer(Request $request)
    {
        $team_id = $request['team-id'];
        $move_id = $request['move-id'];
        $answer = $request['answer'];

        if (empty($answer)) return back();

        $a = new Answer();
        $a->answer = $answer;
        $a->move_id = $move_id;
        $a->save();

        $move = Move::where('team_id', $team_id)->orderBy('id', 'desc')->first();
        if ($move->status === '1') {
            $move->update(['status' => 2]);
            return redirect('/game/result/' . $team_id);
        }

        return redirect('/game?team=' . $team_id);
    }

    public function result($team_id)
    {
        $team = Team::where('id', $team_id)->first();
        $percent = 0;
        foreach ($team->evidences as $evidence) {
            $percent += $evidence->percent;
        }
        return view('result', ['percent' => $percent]);
    }
}
