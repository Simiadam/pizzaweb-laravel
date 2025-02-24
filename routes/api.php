<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PizzaController;
use App\Http\Controllers\API\MessageController;
use App\Http\Controllers\API\OrderController;

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

//get-pizzas api lekéri a keresett pizzákat, rendezéssel és lapozással
Route::post('/get-pizzas', [PizzaController::class, 'getPizzas']);

//get-basketInfo api frontendról kapott kosár tartalmát ellenőrzi és visszaadja a pizzákat és ezeknek az árát
Route::post('/get-basketInfo', [PizzaController::class, 'basketInfo']);

//üzenet küldése az elérhetőségek oldalon
Route::post('/post-sendMessage', [MessageController::class, 'sendMessage']);

//megrendelés küldése
Route::post('/post-sendOrder', [OrderController::class, 'sendOrder']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
