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

class AuthController extends Controller
{
    // تسجيل دخول المسؤول

    public function login(Request $request)
{
    $admin = Admin::where('username', $request->username)->first();

    if ($admin && Hash::check($request->password, $admin->password)) {
        Auth::login($admin);
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
