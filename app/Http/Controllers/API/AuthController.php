<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function register(Request $request){
        //validation
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'password_confirmation' => 'required|same:password'
        ]);

        //handle validation errors
        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400);
        }

        //hash password


        //user exists create user
        if(!User::where('email', $request->email)->exists()){
            $password = bcrypt($request->password);
            try{
                $user = new User();
                $user->email = $request->email;
                $user->password = $password;
                $user->save();

               $data['token'] = $user->createToken('uer_token')->plainTextToken;
               $data['email'] = $user->email;

               $res = [
                    'success' => true,
                    'data' => $data,
                    'message' => 'User created successfully'
                ];
                return response()->json($res, 201);

            }catch(\Exception $e){
                $response = [
                    'success' => false,
                    'message' => 'Failed to create user'
                ];
                return response()->json($response, 409);
            }

        }else{
            //user does not exist
            $response = [
                'success' => false,
                'message' => 'User with this email already exists'
            ];
            return response()->json($response, 409);
        }
    }

    public function login(Request $request){
        if(Auth::attempt(['email'=> $request->email, 'password'=> $request->password])){

            $user = $request->user();
            $data['token'] = $user->createToken('uer_token')->plainTextToken;
            $data['email'] = $user->email;

            $response = [
                 'success' => true,
                 'data' => $data,
                 'message' => 'User logged in successfully'
             ];
             return response()->json($response, 200);
        }
    }
}
