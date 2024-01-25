<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PersonalAccessToken;

class TokenController extends Controller
{
    public function index($id){
        $token = PersonalAccessToken::where('id',$id)->get();
        return $token[0]->tokenable_id;
    }
}
