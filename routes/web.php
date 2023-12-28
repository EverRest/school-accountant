<?php
declare(strict_types=1);

use App\Livewire\Courses\Course;
use App\Livewire\Courses\Courses;
use App\Livewire\Courses\CreateCourse;
use App\Livewire\Courses\UpdateCourse;
use App\Livewire\Groups\CreateGroup;
use App\Livewire\Groups\Group;
use App\Livewire\Groups\Groups;
use App\Livewire\Groups\UpdateGroup;
use App\Livewire\Lessons\CreateLesson;
use App\Livewire\Lessons\Lesson;
use App\Livewire\Lessons\Lessons;
use App\Livewire\Lessons\UpdateLesson;
use App\Livewire\Packages\CreatePackage;
use App\Livewire\Packages\Package;
use App\Livewire\Packages\Packages;
use App\Livewire\Packages\UpdatePackage;
use App\Livewire\Pages\Dashboard;
use App\Livewire\Pages\LoginForm;
use App\Livewire\Pages\LogOut;
use App\Livewire\Pages\Reports;
use App\Livewire\Pages\Statistics;
use App\Livewire\Payments\PaymentIncome;
use App\Livewire\Payments\PaymentOutcome;
use App\Livewire\Payments\Payments;
use App\Livewire\Users\Administrators;
use App\Livewire\Users\CreateAdministrator;
use App\Livewire\Users\CreateStudent;
use App\Livewire\Users\CreateTeacher;
use App\Livewire\Users\Students;
use App\Livewire\Users\Teachers;
use App\Livewire\Users\UpdateStudent;
use App\Livewire\Users\UpdateTeacher;
use App\Livewire\Users\UpdateUser;
use App\Livewire\Users\User;
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
