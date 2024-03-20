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
Route::post('/users', [UserController::class, 'store']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::group(['middleware' => ['auth:sanctum']], function () {
	Route::post('/logout', [LoginController::class, 'logout']);

    /*handle documents */
    Route::post('/addDoc', [DocumentController::class ,'store']);
    Route::get('/documents', [DocumentController::class ,'index']);
    Route::delete('/documents', [DocumentController::class ,'destroy']);
    Route::put('/documents/{doc_id}', [DocumentController::class ,'update']);
    Route::post('/documents/description', [DocumentController::class ,'description']);

    /*handle document_requets*/
    Route::post('/addReq', [DocumentRequestController::class ,'store']);
    Route::get('/requests', [DocumentRequestController::class ,'index']);
    Route::post('/contacts', [DocumentRequestController::class ,'getContacts']);
    Route::delete('/requests', [DocumentRequestController::class ,'destroy']);
    Route::put('/requests/{req_id}', [DocumentRequestController::class ,'update']);

});
