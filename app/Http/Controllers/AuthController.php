<?php
//  من تسجيل دخول المسؤول
/**
 * AuthController
 * 
 * - مسؤول عن وظائف تسجيل الدخول (Login) وتسجيل الخروج (Logout).
 * 
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Tymon\JWTAuth\Facades\JWTAuth;
class AuthController extends Controller
{
    // تسجيل دخول المسؤول
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials.'], 401);
        }

        return response()->json([
            'message' => 'Login successful.',
            'token' => $token,
        ]);
    }

    // تسجيل الخروج
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Logged out successfully.']);
    }
}
