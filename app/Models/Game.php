<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'room',
    ];

    public function gamePlayers(){
        return $this->hasMany(GamePlayer::class, 'gameId');
    }
}
