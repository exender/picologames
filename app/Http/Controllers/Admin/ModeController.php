<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mode;
use App\Http\Requests\StoreModeRequest;
use App\Http\Requests\UpdateModeRequest;

class ModeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modes = Mode::all();

        return $modes;
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
     * @param  \App\Http\Requests\StoreModeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreModeRequest $request)
    {
        $mode = $request->validate([
            'name' => 'required',
        ]);
        

        Mode::create($mode);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mode  $mode
     * @return \Illuminate\Http\Response
     */
    public function show(Mode $mode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mode  $mode
     * @return \Illuminate\Http\Response
     */
    public function edit(Mode $id)
    {
        $mode = Mode::find($id);
        return $mode[0];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateModeRequest  $request
     * @param  \App\Models\Mode  $mode
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateModeRequest $request, $id)
    {
        $mode = Mode::find($id);

        $request = $request->validate([
            'name'=> 'required'
        ]);

        $mode->update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mode  $mode
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mode = Mode::find($id);

        $mode->delete();
    }
}
