<?php

namespace App\Http\Controllers\Admin;

use App\Move;
use App\Resource;
use App\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class GameController extends Controller
{
    public $array_path = [
        'icon' => 'ibgame/img/',
        'resource' => 'ibgaem/file/resource/',
        'evidence' => 'ibgame/file/evidence/',
        'trigger' => 'ibgame/file/trigger/'
    ];

    public function index()
    {
        //
    }

    public function create()
    {

    }

    public function resource(Request $request)
    {
        $resource_name = $request['resource'];
        $save_send = $request['save-send'];
        $team_id = $request['team-id'];
        if (empty($resource_name)) return back();
        if ($save_send == 'send') {
            $this->sendResource($resource_name, $team_id);
        } else {
            $this->saveResourse($resource_name);
        }
    }

    private function saveResourse($name)
    {
        $resource = Resource::where('resource', $name)->first();
        if (!empty($resource)) return $resource->id;
        $resource = new Resource();
        $resource->resource = $name;
        $resource->save();
        return $resource->id;
    }

    private function sendResource($name, $team_id)
    {

        $teamResource = new TeamResource();
        $teamResource->resourse_id = $this->saveResourse($name);
        $teamResource->team_id = $team_id;
        $teamResource->save();
    }

    public function store(Request $request)
    {
        $teamName = $request['name'];
        $moves = $request['moves'];
        $moveTime = $request['time'];
        $teamDescription = $request['description'];

        if (empty($teamName) || empty($moves) || empty($teamDescription)) return back();

        $team = new Team();
        $team->team = $teamName;
        $team->description = $teamDescription;
        $team->icon = $this->uploadFile('icon');
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

    public function uploadFile($key)
    {

        if (Input::file($key)) {
            $input = Input::file($key);
            $extension = $input->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '.' . $extension;
            $destinationPath = public_path($this->array_path[$key]);
            $input->move($destinationPath, $fileName);
            return $fileName;
        }
        return null;
    }

    public function deleteCurrentImage($currentFile, $key)
    {
        if (true === $this->fileExists($currentFile, $key)) {
            unlink(public_path($this->array_path[$key] . $currentFile));
        }
    }

    private  function fileExists($currentFile, $key)
    {
        if (!empty($currentFile) && $currentFile != null) {
            return file_exists(public_path($this->array_path[$key] . $currentFile));
        }
    }
}
