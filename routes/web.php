<?php
declare(strict_types=1);

use App\Livewire\Administrators;
use App\Livewire\LoginForm;
use App\Livewire\Students;
use App\Livewire\Teachers;
use App\Livewire\Welcome;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', Welcome::class);
Route::get('/login', LoginForm::class);
Route::group(['middleware' => ['auth']], function () {
    Route::get('/administrators', Administrators::class);
    Route::get('/teachers', Teachers::class);
    Route::get('/students', Students::class);
});
