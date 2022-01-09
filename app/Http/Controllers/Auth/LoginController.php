<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function registro(LoginRequest $request){
      $user = User::create([
          'name'=>$request['name'],
          'email'=>$request['email'],
          'password'=> Hash::make($request['password'])
      ]);

      $token = $user->createToken($user->name)->plainTextToken;
      return response()->json([
        'token'=> $token,
         'message' => 'Login Success'
    ],200);
    }
    

    public function login(LoginRequest $request){
        if(Auth::attempt($request->only('email','password'))){
            $user = User::where('email',$request['email'])->first();
            $token = $user->createToken($user->name)->plainTextToken;
            return response()->json([
                'token'=> $token,
                 'message' => 'Login Success'
            ],200);
        }
        else{
            return response()->json([
                'error' => 'Datos de acceso incorrecto'
            ], 401);
        }

      /*  $user = User::where('email', $request->email)->first();
        
        if($user){
            if(password_verify($request->password, $user->password)){
                return response()->json([
                    'token'=> $user()->create_token($request->name)->plainTexToken,
                     'message' => 'Login Success'
    
                ],200);
            }
            else{
                return response()->json([
                'error' => 'datos de acceso incorrectos'
            ], 401);
            }
        }*/
        }
        public function logout(Request $request){
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                'message'=>'ELIMINADO'
            ], 200);
        }

}
