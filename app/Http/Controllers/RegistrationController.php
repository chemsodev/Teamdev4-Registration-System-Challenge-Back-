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
use Illuminate\Support\Facades\Log;


class RegistrationController extends Controller
{
    // Register Team Leader
    public function registerTeamLeader(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:participants,email',
            'phone' => 'required|string|max:15',
            'team_name' => 'required|string|max:100',
        ]);

        try {
            $team = Team::create([
                'team_name' => $validated['team_name'],
                'status' => 'pending',
            ]);

            $leader = Participant::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'team_id' => $team->id,
                'is_leader' => true,
            ]);
            $team->leader_id = $leader->id;
            $team->save(); 
            return response()->json([
                'message' => 'Team leader registered successfully.',
                'team_id' => $team->id,
                'team_status' => $team->status,
            ], 201);
        } catch (\Exception $e) {
            Log::error("Error in registerTeamLeader: " . $e->getMessage());
            return response()->json(['message' => 'Error while registering team leader.'], 500);
        }
    }

    // Register Team Member
    public function registerTeamMember(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:participants,email',
            'phone' => 'required|string|max:15',
            'team_id' => 'required|exists:teams,id',
        ]);

        try {
            
            $member = Participant::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'team_id' => $validated['team_id'],
                'is_leader' => false,
            ]);

            return response()->json(['message' => 'Team member registered successfully.'], 201);
        } catch (\Exception $e) {
            Log::error("Error in registerTeamMember: " . $e->getMessage());
            return response()->json(['message' => 'Error while registering team member.'], 500);
        }
    }
}
