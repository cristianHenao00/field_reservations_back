<?php

use App\Http\Controllers\FieldsController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\PermissionsRolesController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\RatingsController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\RolesController;
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
    Route::get('permissions', 'index'); //Para obtener todos
    Route::get('permissions/{id}', 'show'); //Para consultar especifico
    Route::post('permissions', 'store'); //Para guardar
    Route::put('permissions/{id}', 'update'); //Para actualizar
    Route::delete('permissions/{id}', 'destroy'); //Para eliminar un registro
});

Route::controller(RolesController::class)->group(function () {
    Route::get('roles', 'index');
    Route::get('roles/{id}', 'show'); //Para consultar especifico
    Route::post('roles', 'store'); //Para guardar
    Route::put('roles/{id}', 'update'); //Para actualizar
    Route::delete('roles/{id}', 'destroy'); //Para eliminar un registro
});

Route::controller(ProfilesController::class)->group(function () {
    Route::get('profiles', 'index'); //Para obtener todos
    Route::get('profiles/{id}', 'show'); //Para consultar especifico
    Route::post('profiles', 'store'); //Para guardar
    Route::put('profiles/{id}', 'update'); //Para actualizar
    Route::delete('profiles/{id}', 'destroy'); //Para eliminar un registro
});

Route::controller(UsersController::class)->group(function () {
    Route::get('users', 'index'); //Para obtener todos
    Route::get('users/{id}', 'show'); //Para consultar especifico
    Route::post('users', 'store'); //Para guardar
    Route::put('users/{id}', 'update'); //Para actualizar
    Route::delete('users/{id}', 'destroy'); //Para eliminar un registro
});

Route::controller(PermissionsRolesController::class)->group(function () {
    Route::get('permission_role', 'index'); //Para obtener todos
    Route::get('permission_role/{id}', 'show'); //Para consultar especifico
    Route::post('permission_role', 'store'); //Para guardar
    Route::put('permission_role/{id}', 'update'); //Para actualizar
    Route::delete('permission_role/{id}', 'destroy'); //Para eliminar un registro
});


Route::controller(TeamsController::class)->group(function () {
    Route::get('teams', 'index');
    Route::get('teams/{id}', 'show');
    Route::post('teams', 'store');
    Route::put('teams/{id}', 'update');
    Route::delete('teams/{id}', 'destroy');
});

Route::controller(UsersTeamController::class)->group(function () {
    Route::get('users_team', 'index');
    Route::get('users_team/{id}', 'show');
    Route::post('users_team', 'store');
    Route::put('users_team/{id}', 'update');
    Route::delete('users_team/{id}', 'destroy');
});

Route::controller(FieldsController::class)->group(function () {
    Route::get('fields', 'index');
    Route::get('fields/{id}', 'show');
    Route::post('fields', 'store');
    Route::put('fields/{id}', 'update');
    Route::delete('fields/{id}', 'destroy');
});

Route::controller(ReservationsController::class)->group(function () {
    Route::get('reservations', 'index');
    Route::get('reservations/{id}', 'show');
    Route::post('reservations', 'store');
    Route::put('reservations/{id}', 'update');
    Route::delete('reservations/{id}', 'destroy');
});

Route::controller(RatingsController::class)->group(function () {
    Route::get('ratings', 'index');
    Route::get('ratings/{id}', 'show');
    Route::post('ratings', 'store');
    Route::put('ratings/{id}', 'update');
    Route::delete('ratings/{id}', 'destroy');
});

Route::controller(UsersRatingsController::class)->group(function () {
    Route::get('users_rating', 'index');
    Route::get('users_rating/{id}', 'show');
    Route::post('users_rating', 'store');
    Route::put('users_rating/{id}', 'update');
    Route::delete('users_rating/{id}', 'destroy');
});
