<?php
// routes/api.php
/**
 * API Routes
 * 
 * - يحتوي على جميع المسارات (Routes) الخاصة بواجهة API.
 * - يتم استخدامها لتوفير البيانات أو العمليات للواجهة الأمامية.
 * 
 */
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegistrationController;


// ======= Admin Routes =======

// عرض جميع المشاركين
Route::get('/admin/participants', [AdminController::class, 'getAllParticipants']);

// عرض جميع الفرق
Route::get('/admin/teams', [AdminController::class, 'getAllTeams']);

// حذف مشارك
Route::delete('/admin/participants/{id}', [AdminController::class, 'deleteParticipant']);

// حذف فريق
Route::delete('/admin/teams/{id}', [AdminController::class, 'deleteTeam']);

// عرض الإحصائيات
Route::get('/admin/statistics', [AdminController::class, 'getStatistics']);


// ======= Auth Routes =======

// تسجيل دخول المسؤول
Route::post('/auth/login', [AuthController::class, 'login']);

// تسجيل الخروج
Route::post('/auth/logout', [AuthController::class, 'logout']);


// ======= Registration Routes =======

// تسجيل رئيس فريق
Route::post('/register/team-leader', [RegistrationController::class, 'registerTeamLeader']);

// تسجيل عضو فريق
Route::post('/register/team-member', [RegistrationController::class, 'registerTeamMember']);


// ======= Team Routes =======

// عرض تفاصيل فريق معين
Route::get('/teams/{id}', [TeamController::class, 'getTeamDetails']);

// تعديل بيانات الفريق
Route::put('/teams/{id}', [TeamController::class, 'updateTeam']);

// حذف فريق
Route::delete('/teams/{id}', [TeamController::class, 'deleteTeam']);

// عرض أعضاء الفريق
Route::get('/teams/{id}/members', [TeamController::class, 'getTeamMembers']);
