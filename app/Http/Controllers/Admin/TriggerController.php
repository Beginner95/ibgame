<?php

namespace App\Http\Controllers\Admin;

use App\Team;
use App\Trigger;
use App\UploadFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TriggerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request['trigger-name'];
        $save_send = $request['save-send'];
        $team_id = $request['team-id'];

        if (empty($name)) return back();

        if ($save_send == 'send') {
            $this->sendTrigger($name, $team_id);
        } else {
            $this->saveTrigger($name);
        }
        return redirect('/admin?team=' . $team_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trigger = Trigger::where('id', $id)->first();
        $file = $trigger->file;
        if (!empty($file)) {
            $upFile = new UploadFile();
            $upFile->deleteCurrentFile($file, 'trigger');
        }
        $trigger->teams()->detach();
        $trigger->delete();
        return back();
    }

    private function sendTrigger($name, $team_id)
    {
        $team = Team::where('id', $team_id)->first();
        $triggerId = $this->saveTrigger($name);
        $team->triggers()->attach($triggerId);
        $team->description = $team->description . '<p class="color-add-text">' . $name . '</p>';
        $team->save();
    }

    private function saveTrigger($name)
    {
        $trigger = Trigger::where('trigger', $name)->first();
        if (!empty($trigger)) return $trigger->id;

        $upFile = new UploadFile();
        $trigger = new Trigger();
        $trigger->trigger = $name;
        $trigger->file = $upFile->uploadFile('trigger');
        $trigger->save();
        return $trigger->id;
    }
}
