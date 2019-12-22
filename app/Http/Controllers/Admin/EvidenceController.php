<?php

namespace App\Http\Controllers\Admin;

use App\Evidence;
use App\Team;
use App\UploadFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EvidenceController extends Controller
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
        $name = $request['evidence-name'];
        $save_send = $request['save-send'];
        $team_id = $request['team-id'];

        if (empty($name)) return back();

        if ($save_send == 'send') {
            $this->sendEvidence($name, $team_id);
        } else {
            $this->saveEvidence($name);
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
        $trigger = Evidence::where('id', $id)->first();
        $file = $trigger->file;
        if (!empty($file)) {
            $upFile = new UploadFile();
            $upFile->deleteCurrentFile($file, 'evidence');
        }
        $trigger->teams()->detach();
        $trigger->delete();
        return back();
    }

    private function sendEvidence($name, $team_id)
    {
        $team = Team::where('id', $team_id)->first();
        $evidenceId = $this->saveEvidence($name);
        $team->evidences()->attach($evidenceId);
        $team->description = $team->description . '<br>' . $name;
        $team->save();
    }

    private function saveEvidence($name)
    {
        $evidence = Evidence::where('clue', $name)->first();
        if (!empty($evidence)) return $evidence->id;

        $upFile = new UploadFile();
        $evidence = new Evidence();
        $evidence->clue = $name;
        $evidence->file = $upFile->uploadFile('evidence');
        $evidence->save();
        return $evidence->id;
    }
}
