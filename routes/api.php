<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::resource('users', UserController::class);
Route::group(['middleware' => ['web']], function () {
	Route::post('/login', [LoginController::class, 'authenticate']);
	Route::post('/logout', [LoginController::class, 'logout']);
});
//Route::post('/logout', [LoginController::class, 'logout']);
/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
