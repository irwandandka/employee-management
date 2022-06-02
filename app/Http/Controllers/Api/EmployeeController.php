<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeesRequest;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $employees = Employee::with('department','country','state','city')->get();
        if($request->has('search') || $request->has('department_id')) {
            $employees = Employee::where('firstname', 'like', "%{$request->search}%")
            ->orWhere('middlename', 'like', "%{$request->search}%")
            ->orWhere('lastname', 'like', "%{$request->search}%")
            ->orWhere('department_id', $request->department_id)
            ->with('department','country','state','city')
            ->get();
        }
        return response()->json($employees);
    }

    public function show(Employee $employee)
    {
        return response()->json($employee);
    }

    public function store(EmployeesRequest $request)
    {
        Employee::create($request->all());
        return response()->json(['message' => 'Employee successfully created.']);
    }

    public function update(Employee $employee, EmployeesRequest $request)
    {
        $employee->update($request->validated());
        return response()->json(['message' => 'Employee updated successfully.']);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json([
            'message' => 'Employee deleted successfully.'
        ]);
    }
}
