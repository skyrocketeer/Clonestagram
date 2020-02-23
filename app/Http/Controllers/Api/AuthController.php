<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class AuthController extends Controller
{
    // public function __construct(){
    //     $this->middleware('client_credentials');
    // }
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login (Request $request){
        // $credentials = $request->validate([
        //     'email' => 'required|string|email',
        //     'password' => 'required|string'
        // ]);
        
        // if(!Auth::attempt($credentials))
        //     return response()->json([
        //         'error' => 'Unauthorized'
        //     ],401);

        // $user = $request->user();
        // $token = $user->createToken('authToken',['control-post']);
        //
        
        // return response()->json([
        //     'access_token' => $token->accessToken,
        //     'token_type' => 'Bearer',
        //     'expires_at' => Carbon::parse(
        //         $token->token->expires_at
        //     )->toDateTimeString(),
        //     'scope' => $token->scopes
        //     ]);
    }
}
