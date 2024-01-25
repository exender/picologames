<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token=$user->createToken('token-name');

        if(Auth::attempt($request->only('email','password'))){
            return response()->json([Auth::User(),200,$token->plainTextToken]);
        }
    }
}
