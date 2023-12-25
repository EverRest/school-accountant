<?php
declare(strict_types=1);

use App\Livewire\Administrators;
use App\Livewire\Course;
use App\Livewire\Courses;
use App\Livewire\CreateAdministrator;
use App\Livewire\CreateCourse;
use App\Livewire\CreateGroup;
use App\Livewire\CreateLesson;
use App\Livewire\CreatePackage;
use App\Livewire\CreateStudent;
use App\Livewire\CreateTeacher;
use App\Livewire\Dashboard;
use App\Livewire\Group;
use App\Livewire\Groups;
use App\Livewire\Lesson;
use App\Livewire\Lessons;
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
use App\Livewire\UpdateLesson;
use App\Livewire\UpdatePackage;
use App\Livewire\UpdateStudent;
use App\Livewire\UpdateTeacher;
use App\Livewire\UpdateUser;
use App\Livewire\User;
use App\Livewire\Package;
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

Route::get('/', Dashboard::class)->name('welcome');
Route::get('/login', LoginForm::class)->name('login');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/log-out', LogOut::class)->name('log-out');
    Route::group(['prefix' => 'courses', 'as' => 'courses.',], function () {
        Route::get('/', Courses::class)->name('list');
        Route::get('/{course}/update', UpdateCourse::class)->name('update');
        Route::get('/create', CreateCourse::class)->name('create');
        Route::get('/{course}', Course::class)->name('show');
        Route::delete('/{course}')->name('delete');
    });
    Route::group(['prefix' => 'administrators'], function () {
        Route::get('/', Administrators::class)->name('administrators.list');
        Route::get('/{user}/update', UpdateUser::class)->name('administrators.update');
        Route::get('/create', CreateAdministrator::class)->name('administrators.create');
    });
    Route::group(['prefix' => 'teachers'], function () {
        Route::get('/', Teachers::class)->name('teachers.list');
        Route::get('/create', CreateTeacher::class)->name('teachers.create');
        Route::get('/{user}/update', UpdateTeacher::class)->name('teachers.update');
    });
    Route::group(['prefix' => 'students'], function () {
        Route::get('/', Students::class)->name('students.list');
        Route::get('/create', CreateStudent::class)->name('students.create');
        Route::get('/{user}/update', UpdateStudent::class)->name('students.update');
    });
    Route::group(['prefix' => 'users'], function () {
        Route::delete('/{user}')->name('users.delete');
        Route::get('/{user}', User::class)->name('users.show');
        Route::get('/{user}/update', UpdateUser::class)->name('users.update');
    });
    Route::get('/statistics', Statistics::class)->name('statistics');
    Route::get('/payments', Payments::class)->name('payments');
    Route::group(['prefix' => 'lessons'], function () {
        Route::get('/create', CreateLesson::class)->name('lessons.create');
        Route::get('/{lesson}/update', UpdateLesson::class)->name('lessons.update');
        Route::get('/{lesson}', Lesson::class)->name('lessons.show');
        Route::get('/', Lessons::class)->name('lessons.list');
        Route::delete('/{lesson}')->name('lessons.delete');
    });
    Route::group(['prefix' => 'groups'], function () {
        Route::get('/create', CreateGroup::class)->name('groups.create');
        Route::get('/{group}/update', UpdateGroup::class)->name('groups.update');
        Route::get('/{group}', Group::class)->name('groups.show');
        Route::get('/', Groups::class)->name('groups.list');
        Route::delete('/{group}')->name('groups.delete');
    });
    Route::group(['prefix' => 'packages'], function () {
        Route::get('/', Packages::class)->name('packages.list');
        Route::get('/create', CreatePackage::class)->name('packages.create');
        Route::get('/{package}/update', UpdatePackage::class)->name('packages.update');
        Route::get('/{package}', Package::class)->name('packages.show');
        Route::delete('/{package}')->name('packages.delete');
    });
    Route::get('/income', PaymentIncome::class)->name('payments.income');
    Route::get('/outcome', PaymentOutcome::class)->name('payments.outcome');
    Route::get('/reports', Reports::class)->name('payments.reports');
});
