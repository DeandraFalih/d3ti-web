<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientLoginController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function process(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $username = $request->old('username');
        $password = $request->old('password');

        $data = [
            'user_username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        if(Auth::attempt($data)){
            $user = Auth::user();
            $latestToken = $user->tokens()->latest()->first();

            if ($latestToken) {
                $latestToken->delete();
            }

            session()->forget('api_token');

            if(empty($token) || $user->tokenHasExpired()) {
                $token = $user->createToken('Token Sanctum')->plainTextToken;
                session(['api_token' => $token]);
            }

            return redirect('/d3ti-admin');
        }else{
            Session::flash('message', 'Username atau Password Salah!'); 
            Session::flash('alert-class', 'alert-danger'); 
            return redirect('/d3ti-login');
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/d3ti-login');
    }    
}
