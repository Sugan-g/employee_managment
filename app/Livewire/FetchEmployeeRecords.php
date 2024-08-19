<?php


namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use Illuminate\Http\Request;

class FetchEmployeeRecords extends Component
{
    // Method to fetch all employees
    public function fetchAll()
    {
        dd('ddd');
        $employees = Employee::all();
        return response()->json($employees);
    }

    // Method to search for an employee by register number, contact number, or email address
    public function search(Request $request)
    {
        $query = Employee::query();

        if ($request->has('employee_register_number')) {
            $query->where('employee_register_number', $request->input('employee_register_number'));
        }

        if ($request->has('contact_number')) {
            $query->orWhere('contact_number', $request->input('contact_number'));
        }

        if ($request->has('email')) {
            $query->orWhere('email', $request->input('email'));
        }

        $employees = $query->get();
        return response()->json($employees);
    }

    public function render()
    {
        return view('livewire.fetch-employee-records');
    }
}
