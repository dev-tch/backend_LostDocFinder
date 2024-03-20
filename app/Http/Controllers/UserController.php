<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * create new user
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'username' => 'required|string|unique:users',
            'password'=>'required|string'
        ]);
        if ($validator->stopOnFirstFailure()->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }
        $user = new User($request->all());
        if($user->save()){
            return response()->json([
            'message' => 'Successfully created user!',
            ],201);
        }
        else{
            return response()->json(['error'=>'Failed to create user'], 422);
        }
    }
}
