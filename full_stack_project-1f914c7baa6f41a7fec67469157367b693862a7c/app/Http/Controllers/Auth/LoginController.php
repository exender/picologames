<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginController extends Controller
{
    public function index(Request $request){
        $request->validate([
            'email' => ['required','email'],
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        $token=$user->createToken('token-name');

       


        if(Auth::attempt($request->only('email','password'))){
            return response()->json([Auth::User(),200,$token->plainTextToken]);
        }
        throw ValidationException::withMessages([
            'email'=>['Something wrong']
        ]);
    }

    public function logout(){
        Auth::logout();
    }
}
