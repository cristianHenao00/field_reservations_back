<?php

use App\Http\Controllers\FieldsController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\PermissionsRolesController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\RatingsController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UsersRatingsController;
use App\Http\Controllers\UsersTeamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(PermissionsController::class)->group(function () {
    Route::get('permissions', 'index')->middleware(['user-access', 'permission-access']);
    Route::get('permissions/{id}', 'show')->middleware(['user-access', 'permission-access']);
    Route::post('permissions', 'store')->middleware(['user-access', 'permission-access']);
    Route::put('permissions/{id}', 'update')->middleware(['user-access', 'permission-access']);
    Route::delete('permissions/{id}', 'destroy')->middleware(['user-access', 'permission-access']);
});

Route::controller(RolesController::class)->group(function () {
    Route::get('roles', 'index')->middleware(['user-access', 'permission-access']);
    Route::get('roles/{id}', 'show')->middleware(['user-access', 'permission-access']);
    Route::post('roles', 'store');#->middleware(['user-access', 'permission-access']);
    Route::put('roles/{id}', 'update')->middleware(['user-access', 'permission-access']);
    Route::delete('roles/{id}', 'destroy')->middleware(['user-access', 'permission-access']);
});

Route::controller(ProfilesController::class)->group(function () {
    Route::get('profiles', 'index')->middleware(['user-access', 'permission-access']);
    Route::get('profiles/{id}', 'show')->middleware(['user-access', 'permission-access']);
    Route::post('profiles', 'store')->middleware(['user-access', 'permission-access']);
    Route::put('profiles/{id}', 'update')->middleware(['user-access', 'permission-access']);
    Route::delete('profiles/{id}', 'destroy')->middleware(['user-access', 'permission-access']);
});

Route::controller(UsersController::class)->group(function () {
    Route::get('users', 'index');#->middleware(['user-access', 'permission-access']);
    Route::get('users/{id}', 'show');#->middleware(['user-access', 'permission-access']);
    Route::post('users', 'store');
    Route::put('users/{id}', 'update');#->middleware(['user-access', 'permission-access']);
    Route::delete('users/{id}', 'destroy');#->middleware(['user-access', 'permission-access']);
});

Route::controller(PermissionsRolesController::class)->group(function () {
    Route::get('permission_role', 'index')->middleware(['user-access', 'permission-access']);
    Route::get('permission_role/{id}', 'show')->middleware(['user-access', 'permission-access']);
    Route::post('permission_role', 'store')->middleware(['user-access', 'permission-access']);
    Route::put('permission_role/{id}', 'update')->middleware(['user-access', 'permission-access']);
    Route::delete('permission_role/{id}', 'destroy')->middleware(['user-access', 'permission-access']);
});


Route::controller(TeamsController::class)->group(function () {
    Route::get('teams', 'index')->middleware(['user-access', 'permission-access']);
    Route::get('teams/{id}', 'show')->middleware(['user-access', 'permission-access']);
    Route::post('teams', 'store')->middleware(['user-access', 'permission-access']);
    Route::put('teams/{id}', 'update')->middleware(['user-access', 'permission-access']);
    Route::delete('teams/{id}', 'destroy')->middleware(['user-access', 'permission-access']);
});

Route::controller(UsersTeamController::class)->group(function () {
    Route::get('users_team', 'index')->middleware(['user-access', 'permission-access']);
    Route::get('users_team/{id}', 'show')->middleware(['user-access', 'permission-access']);
    Route::post('users_team', 'store')->middleware(['user-access', 'permission-access']);
    Route::put('users_team/{id}', 'update')->middleware(['user-access', 'permission-access']);
    Route::delete('users_team/{id}', 'destroy')->middleware(['user-access', 'permission-access']);
});

Route::controller(FieldsController::class)->group(function () {
    Route::get('fields', 'index')->middleware(['user-access', 'permission-access']);
    Route::get('fields/{id}', 'show')->middleware(['user-access', 'permission-access']);
    Route::post('fields', 'store')->middleware(['user-access', 'permission-access']);
    Route::put('fields/{id}', 'update')->middleware(['user-access', 'permission-access']);
    Route::delete('fields/{id}', 'destroy')->middleware(['user-access', 'permission-access']);
});

Route::controller(ReservationsController::class)->group(function () {
    Route::get('reservations', 'index')->middleware(['user-access', 'permission-access']);
    Route::get('reservations/{id}', 'show')->middleware(['user-access', 'permission-access']);
    Route::post('reservations', 'store')->middleware(['user-access', 'permission-access']);
    Route::put('reservations/{id}', 'update')->middleware(['user-access', 'permission-access']);
    Route::delete('reservations/{id}', 'destroy')->middleware(['user-access', 'permission-access']);
});

Route::controller(RatingsController::class)->group(function () {
    Route::get('ratings', 'index')->middleware(['user-access', 'permission-access']);
    Route::get('ratings/{id}', 'show')->middleware(['user-access', 'permission-access']);
    Route::post('ratings', 'store')->middleware(['user-access', 'permission-access']);
    Route::put('ratings/{id}', 'update')->middleware(['user-access', 'permission-access']);
    Route::delete('ratings/{id}', 'destroy')->middleware(['user-access', 'permission-access']);
});

Route::controller(UsersRatingsController::class)->group(function () {
    Route::get('users_rating', 'index')->middleware(['user-access', 'permission-access']);
    Route::get('users_rating/{id}', 'show')->middleware(['user-access', 'permission-access']);
    Route::post('users_rating', 'store')->middleware(['user-access', 'permission-access']);
    Route::put('users_rating/{id}', 'update')->middleware(['user-access', 'permission-access']);
    Route::delete('users_rating/{id}', 'destroy')->middleware(['user-access', 'permission-access']);
});

Route::controller(SecurityController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('logout', 'logout')->middleware('user-access');
});
