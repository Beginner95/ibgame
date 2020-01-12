<?php

namespace App\Http\Controllers\Admin;

use App\EventOption;
use App\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventOptionController extends Controller
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
        $name = $request['name-event-option'];
        $description = $request['description-event-option'];
        $save_send = $request['save-send'];
        $team_id = $request['team-id'];
        $event_option_id = $request['event-option-id'];

        if (empty($name) || empty($description)) return back();

        if (!empty($event_option_id)) {
            $this->update($request, $event_option_id);
        }

        if ($save_send == 'send') {
            $this->sendEventOption($name, $description, $team_id);
        } else {
            $this->saveEventOption($name, $description);
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
        $name = $request['name-event-option'];
        $description = $request['description-event-option'];
        EventOption::where('id', $id)->update(['name' => $name, 'description' => $description]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eventOption = EventOption::where('id', $id)->first();
        $eventOption->teams()->detach();
        $eventOption->delete();
        return back();
    }

    private function sendEventOption($name, $description, $team_id)
    {
        $team = Team::where('id', $team_id)->first();
        $eventOptionId = $this->saveEventOption($name, $description);
        $team->eventOptions()->attach($eventOptionId);
        $team->description = $team->description . '<p class="color-add-text">' . $description . '</p>';
        $team->save();
    }

    private function saveEventOption($name, $description)
    {
        $eventOption = EventOption::where('name', $name)->where('description', $description)->first();
        if (!empty($eventOption)) return $eventOption->id;
        $eventOption = new EventOption();
        $eventOption->name = $name;
        $eventOption->description = $description;
        $eventOption->save();
        return $eventOption->id;
    }
}
