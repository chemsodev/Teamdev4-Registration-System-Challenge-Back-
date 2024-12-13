<?php

// للتحكم في تسجيل أعضاء الفريق ورؤساء الفريق
/**
 * RegistrationController
 * 
 * - مسؤول عن تسجيل المستخدمين الجدد.
 * - يحتوي على التحقق من البيانات المدخلة (Validation) وحفظ المستخدم في قاعدة البيانات.
 * 
 */

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Team;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    // تسجيل رئيس فريق
    public function registerTeamLeader(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:participants,email',
            'phone' => 'required|string|max:15',
            'team_name' => 'required|string|max:100',
        ]);

        // إنشاء الفريق مع تعيين الحالة إلى "pending" بشكل افتراضي
        $team = Team::create([
            'team_name' => $validated['team_name'],
            'status' => 'pending',  // تعيين الحالة الافتراضية "pending"
        ]);

        // إنشاء رئيس الفريق
        $leader = Participant::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'team_id' => $team->id,
            'is_leader' => true,
        ]);

        // إرسال ID الفريق لرئيس الفريق
        return response()->json([
            'message' => 'Team leader registered successfully.',
            'team_id' => $team->id,
            'team_status' => $team->status,  // إرسال حالة الفريق في الاستجابة
        ]);
    }

    // تسجيل عضو فريق
    public function registerTeamMember(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:participants,email',
            'phone' => 'required|string|max:15',
            'team_id' => 'required|exists:teams,id'
        ]);

        // إنشاء العضو
        $member = Participant::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'team_id' => $validated['team_id'],
            'is_leader' => false,
        ]);

        return response()->json(['message' => 'Team member registered successfully.']);
    }

    // تحديث حالة الفريق (للمستقبل إذا كنت بحاجة لتغيير الحالة)
    public function updateTeamStatus(Request $request, $team_id)
    {
        // التحقق من صحة البيانات المدخلة
        $validated = $request->validate([
            'status' => 'required|in:pending,accepted,refused',
        ]);

        // البحث عن الفريق وتحديث حالته
        $team = Team::findOrFail($team_id);
        $team->update(['status' => $validated['status']]);

        return response()->json([
            'message' => 'Team status updated successfully.',
            'team_id' => $team->id,
            'team_status' => $team->status,
        ]);
    }
}
