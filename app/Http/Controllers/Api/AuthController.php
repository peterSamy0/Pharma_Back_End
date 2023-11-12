<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Client;
use App\Models\Delivery;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), 
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();
            $pharmacy = Pharmacy::where('user_id', $user->id)->first();
            $delivery = Delivery::where('user_id', $user->id)->first();
            $client = Client::where('user_id', $user->id)->first();

            $id = null;
            if ($pharmacy) {
                $id = $pharmacy->id;
            } elseif ($delivery) {
                $id = $delivery->id;
            } elseif ($client) {
                $id = $client->id;  
            }
            return response()->json([
                'status' => true,
                'user_id' => $user->id,
                '_id' => $id,
                'role' => $user->role,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}