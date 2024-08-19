<?php
namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;

class EmployeesImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;

    public function model(array $row)
    {
       $dob = date('Y-m-d', strtotime($row['date_of_birth']));
       
        return Employee::updateOrCreate(
            ['employee_register_number' => $row['employee_register_number']],
            [
                'name' => $row['name'],
                'contact_number' => $row['contact_number'],
                'email' => $row['email'],
                'date_of_birth' => $dob,
                'address' => $row['address'],
            ]
        );
    }

    public function rules(): array
    {
        return [
            // '*.employee_register_number' => 'required|unique:employees,employee_register_number',
            // '*.name' => 'required|string|min:3',
            // '*.contact_number' => 'required|numeric|digits:10',
            // '*.email' => 'required|email|unique:employees,email',
            // '*.date_of_birth' => 'required|date|before:today',
            // '*.address' => 'nullable|string|max:255',
            
        ];
    }
}
