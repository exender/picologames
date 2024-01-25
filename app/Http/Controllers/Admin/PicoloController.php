<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Picolo;
use App\Http\Requests\StorePicoloRequest;
use App\Http\Requests\UpdatePicoloRequest;

class PicoloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $picolos = Picolo::all();

        return $picolos;
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
     * @param  \App\Http\Requests\StorePicoloRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePicoloRequest $request)
    {
        $picolo = $request->validate([
            'mode' => 'required',
            'text' => 'required',
            'sip' => 'required',
        ]);
        

        Picolo::create($picolo);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Picolo  $picolo
     * @return \Illuminate\Http\Response
     */
    public function show(Picolo $picolo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Picolo  $picolo
     * @return \Illuminate\Http\Response
     */
    public function edit(Picolo $id)
    {
        $picolo = Picolo::find($id);
        return $picolo[0];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePicoloRequest  $request
     * @param  \App\Models\Picolo  $picolo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePicoloRequest $request, $id)
    {
        $picolo = Picolo::find($id);

        $request = $request->validate([
            'mode' => 'required',
            'text' => 'required',
            'sip' => 'required',
        ]);

        $picolo->update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Picolo  $picolo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $picolo = Picolo::find($id);

        $picolo->delete();
    }
}
