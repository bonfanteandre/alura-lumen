<?php

namespace App\Http\Controllers;

use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\Controller;

class TokenController extends Controller
{
    public function generate(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (is_null($user) || !Hash::check($request->password, $user->password)) {
            return response()->json('Usuário ou senha inválidos', 401);
        }

        $token = JWT::encode(['email' => $user->email], env('JWT_KEY'));

        return [
            'access_token' => $token
        ];
    }
}
