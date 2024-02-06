<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use App\Models\Picolo;

class Msg implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $gameMsg; 
    /**
     * Create a new event instance.
     *
     * @return void
     */

    public function __construct($gameMsg)
    {
        $this->gameMsg = $gameMsg;
    }

    public function broadcastWith(){
      
        return [
            $this->gameMsg['user'],
            $this->gameMsg['msg'],

        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // dd($this->gameMsg['gameId']);
        return new PrivateChannel('msg.'.$this->gameMsg['gameId']);
    }
}
