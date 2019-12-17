<?php

namespace App\Http\Controllers\Admin;

use App\Resource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResourceController extends Controller
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
        $resource_name = $request['resource'];
        $save_send = $request['save-send'];
        $team_id = $request['team-id'];
        if (empty($resource_name)) return back();
        if ($save_send == 'send') {
            $this->sendResource($resource_name, $team_id);
        } else {
            $this->saveResource($resource_name);
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
        $resource = Resource::where('id', $id)->first();
        $resource->teams()->detach();
        $resource->delete();
        return back();
    }

    private function sendResource($name, $team_id)
    {
        $team = Team::where('id', $team_id)->first();
        $resourceId = $this->saveResource($name);
        $team->eventOptions()->attach($resourceId);
    }

    private function saveResource($name)
    {
        $resource = Resource::where('resource', $name)->first();
        if (!empty($resource)) return $resource->id;
        $resource = new Resource();
        $resource->resource = $name;
        $resource->save();
        return $resource->id;
    }
}