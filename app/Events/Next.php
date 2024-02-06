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

class Next implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $gameId; 
    /**
     * Create a new event instance.
     *
     * @return void
     */

    public function __construct($gameId)
    {
        $this->gameId = $gameId;
    }

    public function broadcastWith(){
      
        return [
            'next'
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // dd($request);
        return new PrivateChannel('next.'.$this->gameId);
    }
}
