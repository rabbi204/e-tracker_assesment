<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

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
    return view('backend.index');
});

//** Category route */
Route::get('/category',[CategoryController::class, 'index'])->name('category.index');
Route::get('/category-create',[CategoryController::class, 'createCategory'])->name('category.create');
Route::post('/category-store',[CategoryController::class, 'categoryStore'])->name('category.store');

Route::get('/category-edit/{id}',[CategoryController::class, 'editCategoryData'])->name('category.edit');
Route::post('/category-update/{id}',[CategoryController::class, 'updateCategoryData'])->name('category.update');
Route::get('/category-delete/{id}',[CategoryController::class, 'categoryDataDelete'])->name('category.delete');

// employee route
Route::get('/employee',[EmployeeController::class, 'index'])->name('employee.index');
Route::get('/employee-create',[EmployeeController::class, 'createEmployee'])->name('employee.create');
Route::post('/employee-store',[EmployeeController::class, 'storeEmployee'])->name('employee.store');

Route::get('/employee-edit/{id}',[EmployeeController::class, 'editEmployee'])->name('employee.edit');
Route::post('/employee-update/{id}',[EmployeeController::class, 'updateEmployee'])->name('employee.update');
Route::get('/employee-delete/{id}',[EmployeeController::class, 'employeeDelete'])->name('employee.delete');