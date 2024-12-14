<?php
// للتحكم في لوحة تحكم المسؤول
/**
 * AdminController
 * 
 * - هذا المتحكم يحتوي على الوظائف المتعلقة بإدارة النظام.
 * - مثال: إضافة أو حذف مستخدمين، إدارة الصلاحيات، أو عرض لوحة تحكم المدير.
 * 
 */
namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
class AdminController extends Controller
{
    // عرض جميع المشاركين
    public function getAllParticipants()
    {
        $participants = Participant::all();
        return response()->json($participants);
    }

    // عرض جميع الفرق
    public function getAllTeams()
    {
        $teams = Team::all();
        return response()->json($teams);
    }

    // حذف مشارك
    public function deleteParticipant($id)
    {
        $participant = Participant::findOrFail($id);
        $participant->delete();

        return response()->json(['message' => 'Participant deleted successfully.']);
    }

    // حذف فريق
    public function deleteTeam($id)
    {
        $team = Team::findOrFail($id);
        $team->delete();

        return response()->json(['message' => 'Team deleted successfully.']);
    }

    // عرض الإحصائيات
    public function getStatistics()
    {
        $statistics = [
            'totalParticipants' => Participant::count(),
            'totalTeams' => Team::count()
        ];
        return response()->json($statistics);
    }
        // registrastion admin
        public function register(Request $request)
        {
            $admin = Admin::create([
                'username' => $request->username,
                'password' => Hash::make($request->password), // تشفير كلمة المرور
            ]);
        
            return response()->json(['message' => 'Admin created successfully.']);
        }

}

