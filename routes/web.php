<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\MonthlyBudgetController;
use App\Http\Controllers\RewardController;

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

Route::view('/login', 'pages.login')->name('login');
Route::view('/register', 'pages.register')->name('register');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware' => ['auth']], function()
{
    Route::get('/', [ExpenseController::class, 'index'])->name('pages.index');
    Route::get('/about', [PagesController::class, 'about'])->name('pages.about');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/user/{userId}', [RewardController::class, 'showPoints'])->name('user.points');
    // test
    Route::get('/create', [ExpenseController::class, 'create'])->name('pages.expense.create');
    Route::post('/create', [ExpenseController::class, 'store'])->name('pages.expense.store');
    Route::get('/edit/{expense}', [ExpenseController::class, 'edit'])->name('pages.expense.edit');
    Route::put('/edit/{expense}', [ExpenseController::class, 'update'])->name('pages.expense.update');
    Route::delete('/delete/{expense}', [ExpenseController::class, 'destroy'])->name('pages.expense.destroy');

    Route::get('/add', [ExpenseCategoryController::class, 'create'])->name('pages.category.create');
    Route::post('/add', [ExpenseCategoryController::class, 'store'])->name('pages.category.store');
    Route::get('/categories/{category}/edit', [ExpenseCategoryController::class, 'edit'])->name('pages.category.edit');
    Route::put('/categories/{category}', [ExpenseCategoryController::class, 'update'])->name('pages.category.update');
    Route::delete('/categories/{category}', [ExpenseCategoryController::class, 'destroy'])->name('pages.category.destroy');

    Route::get('/budget', [MonthlyBudgetController::class, 'index'])->name('pages.monthly.index');
    Route::get('/set', [MonthlyBudgetController::class, 'create'])->name('pages.monthly.create');
    Route::post('/set', [MonthlyBudgetController::class, 'store'])->name('pages.monthly.store');

});

