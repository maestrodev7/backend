<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        
        try{
            $credentials = $request->validate([
                'email'=>['required','email'],
                'password'=>['required'],
            ]);
            $user = User::where('email',$request->email)->first();
            if(!$user || !Hash::check($request->password,$user->password)){
                return response()->json([
                    'message'=>'invalid login credential'
                ]);
            }
            $token = $user->createToken("auth_token",["*"],now()->addHour(2))->plainTextToken;
            $response = [
                "message"=>"user logged successfully",
                "access_token"=>$token,
                "token_type"=>"Barrer",
            ];
            return response()->json($response,200);
        } catch (ValidationException $e) {
            $response = [
                "message"=>"Validation error",
                "error"=>$e->errors(),
            ];
            return response()->json($response,201);
        }catch (QueryException $e) {
            return response()->json([
                'message'=>'Database  error',
                'error'=> $e->getmessage()
            ],500);
        }catch (Exception $e) {
            return response()->json([
                'message'=>'An error occured',
                'error'=> $e->getmessage()
            ],500);
        }
    }
}
