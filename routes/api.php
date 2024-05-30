<?php

use App\Http\Controllers\API\AbsenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\RolesController;
use App\Http\Controllers\API\SettingRolesController;
use App\Http\Controllers\API\ProfilePerusahaanController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'user']);

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    //return $request->user();


//});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/change-password', [AuthController::class, 'change_password']);
    Route::post('/search-user', [AuthController::class, 'search']);
    Route::resource('roles', RolesController::class);
    Route::resource('setting_roles', SettingRolesController::class);
    Route::resource('profile_perusahaan', ProfilePerusahaanController::class);
    Route::resource('absen', AbsenController::class);
});

