<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Services\EmployeeSearchService;

class EmployeesController extends Controller
{
    protected $searchService;

    public function __construct(EmployeeSearchService $searchService)
    {
        $this->searchService = $searchService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with(['department', 'addresses', 'contacts'])->get();
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
        $data = $request->validated();
        $employee = Employee::create($data);
        
        if (!empty($data['addresses'])) {
            foreach ($data['addresses'] as $addr) {
                $employee->addresses()->create($addr);
            }
        }

        if (!empty($data['contacts'])) {
            foreach ($data['contacts'] as $contact) {
                $employee->contacts()->create($contact);
            }
        }

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
        $employee->load(['department', 'addresses', 'contacts']);

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

    public function search(Request $request)
    {
        $employees = $this->searchService->search($request->all());

        if(count($employees) == 0){
            return response()->json([
                'success' => true,
                'message' => "No employee exists for your searched parameters",
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
