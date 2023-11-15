<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class Logout extends Controller
{

    public function logout()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user->tokens->each(function ($token) {
            $token->delete();
        });
    
        return response()->json(['message' => 'Logged out successfully']);
    }

}
