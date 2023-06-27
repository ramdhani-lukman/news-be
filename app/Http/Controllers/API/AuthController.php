<?php

namespace App\Http\Controllers\API;

use App\Helper\HttpResponses;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller{
    public function register(RegisterRequest $request){
        $user = User::create([
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'name'      => $request->name
        ]);
        return HttpResponses::success([
            'user'  => $user,
            'token' => $user->createToken("API_TOKEN_".$user->email)->plainTextToken
        ]);
    }

    public function login(LoginRequest $request){
        if(!Auth::attempt($request->only(['email','password']))){
            return HttpResponses::error("Unauthorized");
        }
        $user   = Auth::user();
        $token  = $user->createToken("API_TOKEN_".$user->email)->plainTextToken;
        return HttpResponses::success([
            'user'  => $user,
            'token' => $user->createToken("API_TOKEN_".$user->email)->plainTextToken
        ]);
    }


}
