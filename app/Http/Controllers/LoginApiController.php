<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class LoginApiController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'exists:users,email'],
            'password' => ['required', 'string']
        ]);

        if(! Auth::attempt($request->input())) {
            return response()->json(['error' => 'email atau password salah'], 422);
        }

        $token = User::where('email', '=', $request->input('email'))
                        ->first()
                        ->createToken('api');
 
        return response()->json(['token' => $token->plainTextToken]);
    }
}
