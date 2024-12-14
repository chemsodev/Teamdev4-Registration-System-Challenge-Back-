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
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

use Tymon\JWTAuth\Facades\JWTAuth;
class AuthController extends Controller
{
    // تسجيل دخول المسؤول (Login)
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
      
        $admin = Admin::where('username', $request->username)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {

            $token = JWTAuth::fromUser($admin);

            return response()->json([
                'message' => 'Login successful.',
                'token' => $token,
            ]);
        }

        return response()->json(['message' => 'Invalid credentials.'], 401);
    }

    // تسجيل الخروج (Logout)
    public function logout()
    {
        // Invalidate the JWT token
        JWTAuth::invalidate(JWTAuth::getToken());

        // Return success message for logout
        return response()->json(['message' => 'Logged out successfully.']);
    }
}