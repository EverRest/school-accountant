<?php
declare(strict_types=1);

use App\Http\Controllers\ApplierBotController;
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

Route::post('applier-bot/webhook', ApplierBotController::class)->name('applier-bot.invoke');
