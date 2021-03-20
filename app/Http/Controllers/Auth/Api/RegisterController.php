<?php

namespace App\Http\Controllers\Auth\Api; 

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisterController extends Controller
{
    public function __invoke(RegisterFormRequest $request)
    {        
        if(isset($request->validator) && $request->validator->fails()) 
        {
            return json_encode($request->validator->errors());
        }     
        
        $user = User::create(array_merge(
            $request->only('name', 'email'),
            ['password' => bcrypt($request->password)]
            ));
        
        Auth::attempt($request->only('email', 'password'));
        
        $token = $user->createToken($user->id . date('d-m-Y H:i:s'));
        
        $token->token->save();        
        
        return response()->json([
            'username' => Auth::user()->name,
            'userid' => Auth::user()->id,
            'token_type' => 'Bearer',
            'token' => $token->accessToken,
        ], 200);
    }
}
