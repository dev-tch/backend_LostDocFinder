<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request)/*: RedirectResponse*/
    {
        $loginUserData = $request->validate([
            'username'=>'required|string|min:6',
            'password'=>'required|min:8'
        ]);
        $user = User::where('username',$loginUserData['username'])->first();
        $hashedPassword = $user->password;
        if(!$user || !Hash::check($loginUserData['password'], $hashedPassword)){
            return response()->json([
                'message' => 'Invalid Credentials'
            ],401);
        }
        $token = $user->createToken($user->username.'-AuthToken')->plainTextToken;
        return response()->json([
            'access_token' => $token,
        ]);
        
    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
    
        return response()->json([
          "message"=>"logged out"
        ]);
    }
}