<?php

namespace App\Http\Controllers\Admin;

use App\Answer;
use App\EventOption;
use App\Evidence;
use App\Move;
use App\Resource;
use App\Team;
use App\Trigger;
use Carbon\Carbon;
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
            $team_id = !empty($team) ? $team->id : '';
        } else {
            $team = Team::where('id', $team_id)->first();
        }

        if (empty($team)) {
            $team = new Team;
            $team->id = 0;
            $team->description = null;
        }

        $move = $this->getMove($team_id);

        return view(env('THEME') . '.admin.index', [
            'teams' => $teams,
            'team' => $team,
            'move' => $move,
            'time' => $this->getTime($move),
            'answer' => $this->getAnswer($team_id),
            'resources' => $this->getResources(),
            'evidences' => $this->getEvidences(),
            'triggers' => $this->getTriggers(),
            'eventOptions' => $this->getEventOptions()
        ]);
    }

    public function getAnswer($team_id)
    {
        $move = Move::where('status', 1)->where('team_id', $team_id)->first();
        if (empty($move)) {
            $move = Move::where('team_id', $team_id)->where('status', 2)->latest('move')->first();
        }

        if (empty($move)) return null;

        return Answer::where('move_id', $move->id)->orderBy('id', 'DESC')->first();
    }

    public function getMove($team_id)
    {
        return Move::where('status', 1)->where('team_id', $team_id)->first();
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

    private function getTime($move)
    {
        if (!empty($move)) {
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
        } else {
            $time = [
                'hour' => '00',
                'minutes' => '00',
                'seconds' => '00',
                'dateTime' => [
                    'date' => '00/00/00',
                    'hour' => '00',
                    'minutes' => '00'
                ]
            ];
        }
        return $time;
    }
}
