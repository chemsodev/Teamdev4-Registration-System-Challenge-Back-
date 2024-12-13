<?php
// لإدارة الفرق
/**
 * TeamController
 * 
 * - مسؤول عن إدارة الفرق (Teams).
 * - مثال: إنشاء فريق جديد، تعديل بيانات فريق، حذف فريق، أو عرض جميع الفرق.
 * 
 */
namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Participant;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    // عرض تفاصيل فريق معين
    public function getTeamDetails($id)
    {
        $team = Team::with('participants')->findOrFail($id);  
        return response()->json($team);
    }

    // تعديل بيانات الفريق
    public function updateTeam(Request $request, $id)
    {
        $validated = $request->validate([
            'team_name' => 'required|string|max:100',
            'status' => 'nullable|in:pending,accepted,refused',  // إضافة التحقق لحالة الفريق
        ]);

        $team = Team::findOrFail($id);
        $team->update($validated);

        return response()->json(['message' => 'Team updated successfully.']);
    }

    // حذف فريق
    public function deleteTeam($id)
    {
        $team = Team::findOrFail($id);
        $team->delete();

        return response()->json(['message' => 'Team deleted successfully.']);
    }

    // عرض أعضاء الفريق
    public function getTeamMembers($id)
    {
        $team = Team::with('participants')->findOrFail($id);  
        return response()->json($team->participants);
    }
}
