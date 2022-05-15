<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{

    public function register(RegisterRequest $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
       
        $data['token'] = $user->createToken('MyApp')->plainTextToken;
        $data['name'] = $user->name;
   
        return response()->json([
            'data' => $data
        ]);
    }
   
    public function login(LoginRequest $request)
    {
        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])){            
            return response()->json(['errors'=>'Unauthorised']);
        } 

        $user = Auth::user(); 
        $data['token'] = $user->createToken('MyApp')->plainTextToken; 
        $data['name'] = $user->name;

        return response()->json([
            'data' => $data
        ]);
    }
}
