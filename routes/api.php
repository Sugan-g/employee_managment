<?php
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Api\EmployeeController;
// use App\Http\Controllers\ApiEmployeeController;
// use App\Livewire\FetchEmployeeRecords;

// use App\Http\Controllers\ApiEmployeeController;


Route::get('/employees-all', [App\Http\Controllers\ApiEmployeeController::class, 'fetchAll']);
Route::get('employees/search', [App\Http\Controllers\ApiEmployeeController::class, 'search']);
