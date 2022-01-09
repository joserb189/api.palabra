<?php

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

Route:: get('palabras',[PalabraController:: class, 'index']);
Route:: get('palabras/{id}',[PalabraController:: class, 'show']);
Route:: post('palabras',[PalabraController:: class, 'store']);
Route:: put('palabras/{id}',[PalabraController:: class, 'update']);
Route:: delete('palabras/{id}',[PalabraController:: class, 'destroy']);


Route:: post('login', [App\Http\Controllers\Auth\LoginController:: class, 'login']);

Route:: post('registro', [App\Http\Controllers\Auth\LoginController:: class, 'registro']);
Route:: middleware('auth:sanctum')->post('logout', [App\Http\Controllers\Auth\LoginController:: class, 'logout']);

