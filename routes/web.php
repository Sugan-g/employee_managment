<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\{EmployeeForm, EmployeeGrid, EmployeeEdit, AdminLogin, Logout};


Route::get('/', AdminLogin::class)->name('login');
Route::middleware('auth:admin')->group(function () {

    Route::get('/employees/create', EmployeeForm::class)->name('employees-create');
    Route::get('/employees', EmployeeGrid::class)->name('employees');
    Route::get('/employees/{id}/edit', EmployeeEdit::class)->name('employees.edit');
    Route::post('/logout', [AdminLogin::class, 'logout'])->name('admin.logout');

});




