<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picolo extends Model
{
    use HasFactory;

    protected $fillable = [
        'mode',
        'text',
        'sip',
    ];
}
