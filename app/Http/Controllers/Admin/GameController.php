<?php

namespace App\Http\Controllers\Admin;

use App\Answer;
use App\EventOption;
use App\Evidence;
use App\Move;
use App\Resource;
use App\Team;
use App\Trigger;
use App\UploadFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class GameController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $teamName = $request['name'];
        $moves = $request['moves'];
        $moveTime = $request['time'];
        $teamDescription = $request['description'];

        if (empty($teamName) || empty($moves) || empty($teamDescription)) return back();

        $upFile = new UploadFile();
        $team = new Team();
        $team->team = $teamName;
        $team->description = $teamDescription;
        $team->icon = $upFile->uploadFile('icon');
        $team->status = 0;
        $team->save();
        $team_id = $team->id;

        $this->createMoves($team_id, $moves, $moveTime);

        return redirect('/admin?team=' . $team_id);
    }

    public function createMoves($team_id, $moves, $moveTime)
    {
        $j = 1;
        $k = 1;
        for ($i = 1; $i <= $moves; $i++) {
            $move = new Move();
            $move->move = $i;
            $move->play_time = $moveTime;
            $move->status = null;

            if ($i === 1) $move->status = 1;

            if ($i%2 === 0) {
                $move->play_time_start = date('Y') . '-02-' . $k .' 17:00:00';
                $k++;
            } else {
                $move->play_time_start = date('Y') . '-02-' . $j .' 10:00:00';
                $j++;
            }

            $move->team_id = $team_id;
            $move->save();
        }
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }

    public function siteMap()
    {
        if (Input::file('site-map')) {
            $input = Input::file('site-map');
            $extension = $input->getClientOriginalExtension();
            $fileName = 'map.' . $extension;
            $destinationPath = public_path('file/site-map/');
            $input->move($destinationPath, $fileName);
            return back();
        }
        return back();
    }

    public function nextMove(Request $request)
    {
        $team_id = $request['team-id'];
        $move_id = $request['move-id'];
        Move::where('id', $move_id)->where('team_id', $team_id)->update(['status' => 2]);
        Move::where('team_id', $team_id)->where('status', null)->first()->update(['status' => 1]);
        return back();
    }

    public function resetGames($id)
    {
        if ($id !== '2048') return back();

        $evenOptions = EventOption::get();
        $resources = Resource::get();
        $evidences = Evidence::get();
        $triggers = Trigger::get();

        $evenOptionController = new EventOptionController;
        foreach ($evenOptions as $evenOption) {
            $evenOptionController->destroy($evenOption->id);
        }

        $resourceController = new ResourceController;
        foreach ($resources as $resource) {
            $resourceController->destroy($resource->id);
        }

        $evidenceController = new EvidenceController;
        foreach ($evidences as $evidence) {
            $evidenceController->destroy($evidence->id);
        }

        $triggerController = new TriggerController;
        foreach ($triggers as $trigger) {
            $triggerController->destroy($trigger->id);
        }

        Answer::query()->delete();
        Move::query()->delete();
        Team::query()->delete();
        return back();
    }
}
