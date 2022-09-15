<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use \App\Models\User;

class AuthController extends Controller
{
   
    public function register(Request $request){   
        $validation = $request->validate([
            'email' => ['unique:users','required','email'],
            'name' => ['required'],
            'password' => ['required']
        ]);
        
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        
        $is_saved = $user->saveOrFail();
        if($is_saved){
            $response = array(
                'error'=>false,
                'user'=>$user,
                //'token' => $user->createToken("Token")->accessToken,
            );
        }
        else{
            $response = array(
                'error'=>true,
                'message'=>"Something wrong",
            );
        }

        return response()->json($response,200);
       
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
        
        if(Auth::attempt($credentials)){

            //   /** @var \App\Models\User $user **/

            //$user = User::find(Auth::user()->id);
            $user = Auth::user();
 
            $result['user'] = $user;
            $result['token'] = $user->createToken('token')->accessToken;
            return response()->json([
                'data'=>$result,
                'error'=>false],
            200);
        }
        return response()->json([
            'message'=>'Unauthorized User',
            'error'=>true
        ],401);
       
    }

    public function getUsers(Request $request){   
        $response = array(
            'error'=>false,
            'users'=> User::All()
        );
        
        return response()->json($response,200);
    }
}
