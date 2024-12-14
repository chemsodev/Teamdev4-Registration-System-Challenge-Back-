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

// Admin Routes
Route::get('/admin/participants', [AdminController::class, 'getAllParticipants']);
Route::get('/admin/teams', [AdminController::class, 'getAllTeams']);
Route::delete('/admin/participants/{id}', [AdminController::class, 'deleteParticipant']);
Route::delete('/admin/teams/{id}', [AdminController::class, 'deleteTeam']);
Route::get('/admin/statistics', [AdminController::class, 'getStatistics']);

// Auth Routes
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout']);

// Registration Routes
Route::post('/register/team-leader', [RegistrationController::class, 'registerTeamLeader']);
Route::post('/register/team-member', [RegistrationController::class, 'registerTeamMember']);

// Team Routes
Route::get('/teams/{id}', [TeamController::class, 'getTeamDetails']);
Route::put('/teams/{id}', [TeamController::class, 'updateTeam']);
Route::get('/teams/{id}/members', [TeamController::class, 'getTeamMembers']);
