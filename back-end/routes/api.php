<?php

use App\Http\Controllers\API\ApartmentController;
use App\Http\Controllers\API\MessageController;
use App\Http\Controllers\API\VisitController;
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

Route::get('/apartments', [ApartmentController::class, 'index']);
Route::get('/user-apartments/{id}', [ApartmentController::class, 'userApartments']);
Route::get('/apartments/{slug}', [ApartmentController::class, 'show']);
Route::get('/apartments-types-services', [ApartmentController::class, 'all']);
Route::post('/register-visit', [VisitController::class, 'store']);

Route::post('/contacts', [MessageController::class, 'store']);
