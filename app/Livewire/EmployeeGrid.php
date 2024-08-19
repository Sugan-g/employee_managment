<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

use Livewire\WithFileUploads;
use App\Imports\EmployeesImport;
// use Maatwebsite\Excel\Facades\Excel;
use Excel;

class EmployeeGrid extends Component
{
    use WithFileUploads;

    public $file;

    
    public $employees;
    public $search = '';
    public $showDeleteModal = false;
    public $deleteEmployeeId;

    protected $listeners = [
        'editEmployee',
        'confirmDelete' => 'handleConfirmDelete',
        'employeeDeleted' => '$refresh',
    ];   

    protected $rules = [
        'file' => 'required|mimes:xlsx'
    ];

    public function import()
    {
        $this->validate();

        try {

            Excel::import(new EmployeesImport, $this->file->path());
            session()->flash('success', 'Employees imported successfully.');

        } catch (\Exception $e) {

            \Log::error('Import failed: ' . $e->getMessage());
            session()->flash('error', 'Failed to import employees.');

        }
    

        $this->reset('file');
        $this->dispatch('employeeDeleted'); 
    }


    public function mount()
    {
        $this->employees = Employee::all();
    }

    public function updatedSearch()
    {
        $this->employees = Employee::where('name', 'like', '%' . $this->search . '%')->get();
    }

    public function editEmployee($employeeId)
    {
        // Redirect to the edit page
        return Redirect::route('employees.edit', ['id' => $employeeId]);
    }

    public function handleConfirmDelete($employeeId)
    {
        $this->deleteEmployeeId = $employeeId;
        $this->showDeleteModal = true;
    }

    public function deleteEmployee()
    {
        if ($this->deleteEmployeeId) {
            Employee::find($this->deleteEmployeeId)->delete();
            $this->showDeleteModal = false;
            $this->dispatch('employeeDeleted'); // Emit an event to notify about deletion
            // logger('Employee deleted and event emitted');
        }
    }


    public function render()
    {
        // dd($this->employees);
        return view('livewire.employee-grid')->layout('layouts.app');
    }

    public function exportPDF()
    {
        // Fetch employee records
        $employees = Employee::all();

        // Load the view and pass the employee data
        $pdf = Pdf::loadView('pdf.employees', compact('employees'));

        // Save PDF to storage and provide download link
        $pdfPath = 'employees.pdf';
        Storage::put($pdfPath, $pdf->output());

        // Return download response
        return response()->download(storage_path('app/' . $pdfPath));
    }

    public function redirectToCreateEmployee()
    {
        return redirect(route('employees-create'));
    }
}

