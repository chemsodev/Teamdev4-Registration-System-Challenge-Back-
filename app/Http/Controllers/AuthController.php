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

class AuthController extends Controller
{
    // تسجيل دخول المسؤول
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json(['message' => 'Login successful.']);
        }

        return response()->json(['message' => 'Invalid credentials.'], 401);
    }

    // تسجيل الخروج
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Logged out successfully.']);
    }
}
