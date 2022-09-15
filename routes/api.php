<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MealController;

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







Route::group(['prefix' => 'auth'], function(){
    Route::post('login',[AuthController::class,'login'])->name('login');
    Route::post('register',[AuthController::class,'register']);
});

Route::get('users',[AuthController::class,'getUsers']);


//Route::middleware(['auth:api','blockIP'])->group(function () { 
Route::middleware(['auth:api','requestLogger'])->group(function () { 
    

    Route::group(['prefix' => 'meals'], function(){
        Route::post('name',[MealController::class,'searchByName']);
        Route::post('category',[MealController::class,'filterByCategory']);
        Route::get('random',[MealController::class,'randomMeal']);
        //Route::get('voter/{id}',[MealController::class,'getVoterById']);
    });
});
