<div>
    @if ($employee)
        <div>
            <h2>Employee Details:</h2>
            <p>Register Number: {{ $employee->employee_register_number}}</p>
            <p>Name: {{ $employee->name }}</p>
            <p>Contact Number: {{ $employee->contact_number }}</p>
            <p>Email: {{ $employee->email }}</p>
            <p>DOB: {{ $employee->date_of_birth}}</p>
            <p>Address: {{ $employee->address}}</p>
        </div>
    @else
        <p>No employee found with the given criteria.</p>
    @endif

    <h2>All Employees:</h2>
    <ul>
        @foreach ($employees as $emp)
            <li>{{ $emp->name }} - {{ $emp->employee_register_number }}</li>
        @endforeach
    </ul>
</div>
