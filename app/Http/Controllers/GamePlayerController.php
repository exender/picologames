<?php

namespace App\Http\Controllers;

use App\Models\GamePlayer;
use App\Models\Game;
use App\Http\Requests\StoreGamePlayerRequest;
use App\Events\Test;
use App\Http\Requests\UpdateGamePlayerRequest;

class GamePlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GamePlayer $gamePlayer, $id)
    {

        $games = GamePlayer::where('gameId','=',$id)->get();

        $players = [];
        

        foreach($games as $game){
            array_push($players,$game->players[0]);

        }
        return $players;

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
     * @param  \App\Http\Requests\StoreGamePlayerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGamePlayerRequest $request)
    {
        $gamePlayer = $request->validate([
            'userId' => 'required',
            'gameId' => 'required',
          
        ]);

        $check = GamePlayer:: where('userId', '=', $request->userId)
                            ->where('gameId', '=', $request->gameId)->first();
        if($check === null){
            broadcast(new Test());
            $createdGame = GamePlayer::create($gamePlayer);
            return $createdGame->id;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GamePlayer  $gamePlayer
     * @return \Illuminate\Http\Response
     */
    public function show(GamePlayer $gamePlayer, $id)
    {
      

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GamePlayer  $gamePlayer
     * @return \Illuminate\Http\Response
     */
    public function edit(GamePlayer $gamePlayer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGamePlayerRequest  $request
     * @param  \App\Models\GamePlayer  $gamePlayer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGamePlayerRequest $request, GamePlayer $gamePlayer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GamePlayer  $gamePlayer
     * @return \Illuminate\Http\Response
     */
    public function destroy(GamePlayer $gamePlayer)
    {
        //
    }
}
