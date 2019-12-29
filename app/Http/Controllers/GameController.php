<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Move;
use App\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(Request $request)
    {
        $team_id = $request['team'];
        $team = Team::where('id', $team_id)->first();
        $move = Move::where('team_id', $team_id)->where('status', 1)->first();

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

        return view(env('THEME') . '.game', [
            'team' => $team,
            'time' => $time,
            'move' => $move
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

        return redirect('/game?team=' . $team_id);
    }
}
