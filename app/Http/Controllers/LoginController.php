<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session; // Add this line
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    // authenticated user via (username/password) + generate session token
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $username = Auth::user()->username;
            $token= $user->createToken('token')->plainTextToken;
            Log:info($token);
            $arr = explode('|', $token);
            $token_value = $arr[1];
            $username = $user->username;
           return response()->json(['access_token' => $token_value , 'username' =>  $username ], 200);
        }

	    return response()->json(['message' => 'Invalid credentials'], 401);
    }
    
    // terminates session of authenticated user
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            "message" => "Logged out successfully"
        ], 200);
    }  
}