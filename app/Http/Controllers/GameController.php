<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use Illuminate\Support\Facades\Auth;
use App\Events\Test;
use App\Events\Redirect;
use App\Events\Next;
use App\Events\Msg;

class GameController extends Controller
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


    public function redirect(StoreGameRequest $gameId)
    {
        // dd($gameId->id);
        broadcast(new Redirect($gameId->id));  
    }

    public function next(StoreGameRequest $gameId)
    {
       
        broadcast(new Next($gameId->id));
    }

    public function msg(StoreGameRequest $gameMsg)
    {

        $msg = [
            'gameId' => $gameMsg->gameId,
            'msg' => $gameMsg->msg,
            'user' => $gameMsg->user,

        ];
        broadcast(new Msg($msg));
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
     * @param  \App\Http\Requests\StoreGameRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGameRequest $request)
    {


        $game = $request->validate([
            'room' => 'required',
          
        ]);
        

        $createdGame = Game::create($game);


        broadcast(new Test());

        return $createdGame->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGameRequest  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGameRequest $request, Game $game)
    {;

        $game = Game::where('room', '=', $request->room)->get();



        // $game->update([
        //     'playerId' => $request->playerId
        // ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        //
    }
}
