<?php

use App\DataTables\UsersDataTable;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemOperatorController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LendingOperatorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::match('GET', 'login', function(){return view('landingpage.index');});

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('dashboard.index');
    })->name('dashboard.index');
    Route::resource('category', CategoryController::class);
    Route::resource('item', ItemController::class);

    Route::middleware('role:admin')->group(function() {
        Route::get('/admin', [UserController::class, 'admin'])->name('dashboard.accounts.admin');
        Route::get('/operator', [UserController::class, 'admin'])->name('dashboard.accounts.operator');
        Route::get('/operator/edit', [UserController::class, 'editOperator'])->name('dashboard.accounts.editOperator');
        Route::get('/account/create', [UserController::class, 'create'])->name('dashboard.accounts.create');
        Route::post('/account/store', [UserController::class, 'store'])->name('dashboard.accounts.store');
        Route::delete('/account/{user:id}', [UserController::class, 'delete'])->name('dashboard.accounts.delete');
        Route::get('/account/{user:id}/edit', [UserController::class, 'edit'])->name('dashboard.accounts.edit');
        Route::put('/account/{user:id}/update', [UserController::class, 'update'])->name('dashboard.accounts.update');
        Route::put('/account/{user:id}/reset', [UserController::class, 'resetPassword'])->name('dashboard.accounts.resetpassword');
    });

    Route::group(['prefix' => 'operator', 'middleware' => 'role:operator'], function() {
        Route::get('item', [ItemOperatorController::class, 'index'])->name('dashboard.operator.item.index');
        Route::get('lending', [LendingOperatorController::class, 'index'])->name('dashboard.operator.lending.index');
        Route::get('lending/create', [LendingOperatorController::class, 'create'])->name('dashboard.operator.lending.create');
        Route::post('lending/create', [LendingOperatorController::class, 'store'])->name('dashboard.operator.lending.store');
        Route::put('lending/{lending:id}', [LendingOperatorController::class, 'returned'])->name('dashboard.operator.lending.returned');
        Route::delete('lending/{lending:id}', [LendingOperatorController::class, 'delete'])->name('dashboard.operator.lending.delete');
    });
});
// Auth::routes();

Route::get('/', [LandingPageController::class, 'index'])->name('landingpage.index');
Route::post('/login', [LoginController::class, 'auth'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/error', function () {
    return view('forbidenPage');
})->name('gkbolehmasuk');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
