<?php

use Bitpanda\Infrastructure\UI\HttpController\AllTransactionsController;
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

Route::middleware(['api'])->prefix('v1/transactions')->group(function () {
    Route::get('/', AllTransactionsController::class);
});
