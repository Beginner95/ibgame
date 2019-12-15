<?php

namespace App\Http\Controllers\Admin;

use App\Answer;
use App\Move;
use App\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $teams = Team::get();
        $team_id = $request['team'];

        if (empty($team_id)) {
            $team = Team::first();
        } else {
            $team = Team::where('id', $team_id)->first();
        }

        return view(env('THEME') . '.admin.index', [
            'teams' => $teams,
            'team' => $team,
            'answer' => $this->getAnswer($team_id)
        ]);
    }

    public function getAnswer($team_id)
    {
        $move = Move::where('status', 2)->where('team_id', $team_id)->first();
        if (empty($move)) return null;
        return Answer::where('move_id', $move->id)->orderBy('id', 'DESC')->first();
    }
}
