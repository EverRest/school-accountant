<?php
declare(strict_types=1);

use App\Livewire\Administrators;
use App\Livewire\LoginForm;
use App\Livewire\Payments;
use App\Livewire\Statistics;
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

Route::get('/', Welcome::class)->name('welcome');
Route::get('/login', LoginForm::class)->name('login');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/administrators', Administrators::class)->name('administrators');
    Route::get('/teachers', Teachers::class)->name('teachers');
    Route::get('/students', Students::class)->name('students');
    Route::get('/statistics', Statistics::class)->name('statistics');
    Route::get('/payments', Payments::class)->name('payments');

});
