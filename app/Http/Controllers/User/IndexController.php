<?php

namespace App\Http\Controllers\User;

use App\Answer;
use App\Move;
use App\Resource;
use App\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $team_id = Auth::user()->team_id;
        if (empty($team_id)) return back();
        $team = Team::where('id', $team_id)->first();
        $move = Move::where('team_id', $team_id)->where('status', 1)->first();

        if (empty($move)) {
            $move = Move::where('team_id', $team_id)->where('status', 2)->latest('move')->first();
            if (!empty($move)) return redirect('/user/result');
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

        return view('user/index', [
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
        Team::whereId($id)->update(['status' => 1]);
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
        $move_id = $request['move-id'];
        $answer = $request['answer'];

        if (empty($answer)) return back();

        $a = new Answer();
        $a->answer = $answer;
        $a->move_id = $move_id;
        $a->save();

        Move::where('id', $move_id)->update(['play_time' => '00:00:00']);

        return redirect('/');
    }

    protected function getMoveNumber($id)
    {
        $move = Move::select('move')->whereId($id)->first();
        return $move->move;

    }

    public function result()
    {
        $team_id = Auth::user()->team_id;
        $team = Team::where('id', $team_id)->first();
        $percent = 0;
        foreach ($team->evidences as $evidence) {
            $percent += $evidence->percent;
        }
        return view('result', ['percent' => $percent]);
    }
}
