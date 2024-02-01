<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class GamePlayer extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId',
        'gameId',
    ];


    public function game(){
        return $this->belongsTo(Game::class, 'id');
    }

    public function players(){
        return $this->hasMany(User::class, 'id', 'userId');
    }
}
