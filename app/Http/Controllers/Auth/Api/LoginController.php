<?php

namespace App\Http\Controllers\Auth\Api; 

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {       
        $credentials = $request->only('email', 'password');
        
        if (! Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'You cannot sign with those credentials',
                'errors' => 'Unauthorised'
            ], 401);
        }
        
        $token = Auth::user()->createToken(Auth::user()->id . date('d-m-Y H:i:s'));
        
        $token->token->save();        
       
        return response()->json([
            'username' => Auth::user()->name,
            'userid' => Auth::user()->id,
            'token_type' => 'Bearer',
            'token' => $token->accessToken,
        ], 200);
    }
}
