<?php

use App\Http\Controllers\InventoryController;
use App\Http\Middleware\ValidateInventory;
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

// Route::post('/add', [InventoryController::class, 'addInventory'])->middleware(ValidateInventory::class);
// Route::get('/read/{id?}',[InventoryController::class,'readInventory',]);
// Route::post('/update',[InventoryController::class,'updateInventory',]);
// Route::post('/delete',[InventoryController::class,'delete',]);

Route::prefix('inventory')->controller(InventoryController::class)->middleware(ValidateInventory::class)->group(function () {
    Route::post('/add',  'addInventory');
    Route::get('/read/{id?}','readInventory');
    Route::post('/update','updateInventory');
    Route::post('/delete','delete');
});