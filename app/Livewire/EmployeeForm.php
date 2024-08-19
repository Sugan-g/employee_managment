<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use Illuminate\Validation\Rule;

class EmployeeForm extends Component
{
    public $name;
    public $contact_number;
    public $email;
    public $date_of_birth;
    public $address;
    public $employee_register_number;

    protected $rules = [
        'name' => 'required|string|min:3',
        'contact_number' => 'required|numeric|unique:employees,contact_number|digits:10',
        'email' => 'required|email|unique:employees,email',
        'date_of_birth' => 'required|date|before:today',
        'address' => 'nullable|string|max:255',
        'employee_register_number' => 'required|unique:employees,employee_register_number',
    ];

    public function mount()
    {
        $this->employee_register_number = $this->generateEmployeeRegisterNumber();
    }

    public function generateEmployeeRegisterNumber()
    {
        $lastEmployee = Employee::orderBy('id', 'desc')->first();
        $lastNumber = $lastEmployee ? intval(substr($lastEmployee->employee_register_number, 3)) : 0;
        return 'EMP' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
    }

    public function submit()
    {
        $this->validate();

        Employee::create([
            'name' => $this->name,
            'contact_number' => $this->contact_number,
            'email' => $this->email,
            'date_of_birth' => $this->date_of_birth,
            'address' => $this->address,
            'employee_register_number' => $this->employee_register_number,
        ]);

        session()->flash('message', 'Employee successfully added!');

        $this->reset(['name', 'contact_number', 'email', 'date_of_birth', 'address']);
        $this->employee_register_number = $this->generateEmployeeRegisterNumber();
    }

    public function render()
    {
        return view('livewire.employee-form')->layout('layouts.app');
    }

    public function redirectToListEmployee()
    {
        return redirect(route('employees'));
    }
}
