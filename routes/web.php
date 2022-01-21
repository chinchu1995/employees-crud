<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeesController;

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

Route::get('/', function () {
    return redirect('employees');
});

Route::prefix('employees')->group(function () {

    Route::get('/', [EmployeesController::class, 'index'])->name('employees.index');
    Route::get('/create', [EmployeesController::class, 'create'])->name('employees.create');
    Route::post('/store', [EmployeesController::class, 'store'])->name('employees.store');
    Route::get('/edit/{id}', [EmployeesController::class, 'edit'])->name('employees.edit');
    Route::post('/update/{id}', [EmployeesController::class, 'update'])->name('employees.update');
    Route::get('/delete/{id}', [EmployeesController::class, 'delete'])->name('employees.delete');

});
