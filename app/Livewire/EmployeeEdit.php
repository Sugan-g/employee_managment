<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;

class EmployeeEdit extends Component
{
    public $employee;
    public $name;
    public $contact_number;
    public $email;
    public $date_of_birth;
    public $address;

    protected $listeners = ['editEmployee' => 'loadEmployee'];

    public function mount($id)
    {
        $this->employee = Employee::findOrFail($id);
        $this->name = $this->employee->name;
        $this->contact_number = $this->employee->contact_number;
        $this->email = $this->employee->email;
        $this->date_of_birth = $this->employee->date_of_birth ?? $this->employee->date_of_birth->format('Y-m-d');
        $this->address = $this->employee->address;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'contact_number' => 'required|unique:employees,contact_number,' . $this->employee->id,
            'email' => 'required|unique:employees,email,' . $this->employee->id,
            'date_of_birth' => 'required|date',
        ]);

        $this->employee->update([
            'name' => $this->name,
            'contact_number' => $this->contact_number,
            'email' => $this->email,
            'date_of_birth' => $this->date_of_birth,
            'address' => $this->address,
        ]);

        session()->flash('message', 'Employee updated successfully.');
        $this->dispatch('employeeUpdated');
    }

    public function render()
    {
        return view('livewire.employee-edit')->layout('layouts.app');
    }

    public function redirectToListEmployee()
    {
        return redirect(route('employees'));
    }
}

