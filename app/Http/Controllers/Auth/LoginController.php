<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class LoginController extends Controller
{
    public function signUp(Request $request)
    {
        $user = User::create([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
        ]);

        return Response::json([
            'result' => $request->all()
        ]);
    }

    public function signIn(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if(!$user || !Hash::check($credentials['password'], $user->password) ) {
            return Response::json([
                'result' => 'пароль или мыло не подходит'
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        $user->save();

        return Response::json([
            'result' => $token
        ]);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }


}
