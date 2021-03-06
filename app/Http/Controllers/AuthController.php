<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use  Illuminate\Support\Facades\Route;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        request()->validate([
            'username' => ['required', 'string', 'email', 'max:255',],
            'password' => ['required', 'string', 'min:8', 'max:255'],
        ]);

        try {
            $username = $request->username;
            $password = $request->password;
            $request->request->add([
                'username' => $username,
                'password' => $password,
                'grant_type' => 'password',
                'client_id' => config('services.passport.client_id'),
                'client_secret' => config('services.passport.client_secret'),
                'scope' => '*'
            ]);
    
            $tokenRequest = Request::create(
                env('APP_URL').'/oauth/token',
                'post'
            );
            $response = Route::dispatch($tokenRequest);
    
            return $response;
            

        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if ($e->getCode() === 400) {
                return response()->json('Invalid Request. Please enter a username or a password.', $e->getCode());
            } else if ($e->getCode() === 401) {
                return response()->json('Your credentials are incorrect. Please try again', $e->getCode());
            }

            return response()->json('Something went wrong on the server.', $e->getCode());
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:12',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required_with:password|same:password|min:8|max:200'
        ]);

        return User::create([
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return response()->json('Logged out successfully', 200);
    }
}