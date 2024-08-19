<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // Fetch all employees
    public function fetchAll()
    {
        dd('ddd');
        $employees = Employee::all();
        return response()->json($employees);
    }

    // Fetch a single employee by register number, contact number, or email address
    public function show($identifier)
    {
        // Attempt to find the employee by register number, contact number, or email address
        $employee = Employee::where('register_number', $identifier)
            ->orWhere('contact_number', $identifier)
            ->orWhere('email', $identifier)
            ->first();

        if ($employee) {
            return response()->json($employee);
        } else {
            return response()->json(['message' => 'Employee not found'], 404);
        }
    }
}
