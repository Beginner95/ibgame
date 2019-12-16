<?php

namespace App\Http\Controllers\Admin;

use App\Answer;
use App\EventOption;
use App\Evidence;
use App\Move;
use App\Resource;
use App\Team;
use App\Trigger;
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
            'answer' => $this->getAnswer($team_id),
            'resources' => $this->getResources(),
            'evidences' => $this->getEvidences(),
            'triggers' => $this->getTriggers(),
            'eventOptions' => $this->getEventOptions()
        ]);
    }

    public function getAnswer($team_id)
    {
        $move = Move::where('status', 2)->where('team_id', $team_id)->first();
        if (empty($move)) return null;
        return Answer::where('move_id', $move->id)->orderBy('id', 'DESC')->first();
    }

    public function getResources()
    {
        return Resource::orderBy('id', 'DESC')->get();
    }

    public function getEvidences()
    {
        return Evidence::orderBy('id', 'DESC')->get();
    }

    public function getTriggers()
    {
        return Trigger::orderBy('id', 'DESC')->get();
    }

    public function getEventOptions()
    {
        return EventOption::get();
    }
}
