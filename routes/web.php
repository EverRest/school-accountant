<?php
declare(strict_types=1);

use App\Livewire\Administrators;
use App\Livewire\Course;
use App\Livewire\Courses;
use App\Livewire\CreateAdministrator;
use App\Livewire\CreateCourse;
use App\Livewire\CreateGroup;
use App\Livewire\CreateStudent;
use App\Livewire\CreateTeacher;
use App\Livewire\Group;
use App\Livewire\Groups;
use App\Livewire\LoginForm;
use App\Livewire\LogOut;
use App\Livewire\Packages;
use App\Livewire\PaymentIncome;
use App\Livewire\PaymentOutcome;
use App\Livewire\Payments;
use App\Livewire\Reports;
use App\Livewire\Statistics;
use App\Livewire\Students;
use App\Livewire\Teachers;
use App\Livewire\UpdateCourse;
use App\Livewire\UpdateGroup;
use App\Livewire\UpdateUser;
use App\Livewire\User;
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
    Route::get('/courses/{course}/update', UpdateCourse::class)->name('courses.update');
    Route::get('/courses/create', CreateCourse::class)->name('courses.create');
    Route::get('/courses', Courses::class)->name('courses.list');
    Route::get('/courses/{course}', Course::class)->name('courses.show');
    Route::delete('/courses/{course}')->name('courses.delete');
    Route::get('/log-out', LogOut::class)->name('log-out');
    Route::get('/administrators', Administrators::class)->name('administrators.list');
    Route::get('/administrators/create', CreateAdministrator::class)->name('administrators.create');
    Route::get('/teachers', Teachers::class)->name('teachers.list');
    Route::get('/teachers/create', CreateTeacher::class)->name('teachers.create');
    Route::get('/students', Students::class)->name('students.list');
    Route::get('/students/create', CreateStudent::class)->name('students.create');
    Route::delete('/users/{user}')->name('users.delete');
    Route::get('/users/{user}', User::class)->name('users.show');
    Route::get('/users/{user}/update', UpdateUser::class)->name('users.update');
    Route::get('/statistics', Statistics::class)->name('statistics');
    Route::get('/payments', Payments::class)->name('payments');
    Route::get('/groups/create', CreateGroup::class)->name('groups.create');
    Route::get('/groups/{group}/update', UpdateGroup::class)->name('groups.update');
    Route::get('/groups/{group}', Group::class)->name('groups.show');
    Route::get('/groups', Groups::class)->name('groups.list');
    Route::delete('/groups/{group}')->name('groups.delete');
    Route::get('/packages', Packages::class)->name('packages.list');
    Route::get('/packages/create', CreateGroup::class)->name('packages.create');
    Route::get('/packages/{package}/update', UpdateGroup::class)->name('packages.update');
    Route::get('/packages/{package}', Group::class)->name('packages.show');
    Route::delete('/packages/{package}')->name('packages.delete');
    Route::get('/income', PaymentIncome::class)->name('payments.income');
    Route::get('/outcome', PaymentOutcome::class)->name('payments.outcome');
    Route::get('/reports', Reports::class)->name('payments.reports');
});
