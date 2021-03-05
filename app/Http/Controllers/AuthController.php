<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $request['password'] = bcrypt($request['password']);
        $user = User::create($request->all());

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json(['token'=>$token, 'user' => $user]);
        
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(!Auth::attempt($request->only('email','password')))
        {
            return response()->json(['status'=>'Invalid Credentials'],400);
        }

        $user = Auth::user();
        $token = Auth::user()->createToken('authToken')->plainTextToken;

        return response()->json(['status'=>'ok','token' => $token]);
    }

    public function userInfo()
    {
        $user = Auth::user();
        foreach($user->countdowns as $countdown)
        {
            if($countdown->finished == false)
            {
                $currentTime = now();
                if($countdown->finishTime < $currentTime)
                {
                    $countdown->update(['finished'=>1]);
                }
            }
        }
        return new UserResource($user);
    }
}
