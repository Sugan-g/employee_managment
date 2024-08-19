<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class ApiEmployeeController extends Controller
{
    public function fetchAll()
    {
        return response()->json(Employee::all());
    }

    public function search(Request $request)
    {
        $registerNumber = $request->query('employee_register_number');
        $contactNumber = $request->query('contact_number');
        $email = $request->query('email');

        $query = Employee::query();

        if ($registerNumber) {
            $query->orWhere('employee_register_number', $registerNumber);
        }

        if ($contactNumber) {
            $query->orWhere('contact_number', $contactNumber);
        }

        if ($email) {
            $query->orWhere('email', $email);
        }

        $employees = $query->get();

        if ($employees->isEmpty()) {
            return response()->json(['message' => 'No employees found'], 404);
        }

        return response()->json($employees);
    }
}
