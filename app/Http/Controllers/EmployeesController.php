<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with('department')->get();
        if(count($employees) == 0){
           return response()->json([
                'success' => true,
                'message' => 'Employees not found.',
                'data' => $employees
            ]); 
        }
        return response()->json([
            'success' => true,
            'message' => 'Employees fetched successfully.',
            'data' => $employees
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $employee = Employee::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Employee created successfully.',
            'data' => $employee
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $employee->load('department');

        return response()->json([
            'success' => true,
            'message' => 'Employee details fetched successfully.',
            'data' => $employee
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Employee updated successfully.',
            'data' => $employee
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->json([
            'success' => true,
            'message' => 'Employee deleted successfully.'
        ]);
    }

    public function search(string $keyword)
    {
        $employees = Employee::with('department')
            ->where('name', 'like', "%{$keyword}%")
            ->orWhere('email', 'like', "%{$keyword}%")
            ->paginate(10);
        if(count($employees) == 0){
            return response()->json([
                'success' => true,
                'message' => "Results not found for this keyword - '{$keyword}'",
                'data' => []
            ]);    
        }
        return response()->json([
            'success' => true,
            'message' => 'Search results.',
            'data' => $employees
        ]);
    }
}
