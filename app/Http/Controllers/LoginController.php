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
	     /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

	    //return "ok login function";
	    return response()->json(['message' => 'Login successful'], 200);

        }

        //return back()->withErrors([
        //    'username' => 'The provided credentials do not match our records.',
	    //])->onlyInput('username');
	return response()->json(['message' => 'Invalid credentials'], 401);
    }
    
    public function logout(Request $request){
   	Auth::logout();
 
    	$request->session()->invalidate();
 
   	$request->session()->regenerateToken(); 
        return response()->json([
          "message"=>"logged out"
        ]);
    }
}
