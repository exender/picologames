<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index($id){
        $user = User::where('id',$id)->get();
        return $user[0]->role;
    }
}
