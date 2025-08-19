<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;

class DepartmentsController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Departments fetched successfully',
            'data' => Department::all()
        ]);
    }

    public function store(StoreDepartmentRequest $request)
    {
        $department = Department::create($request->validated());

        return response()->json([
            'message' => 'Department created successfully',
            'data' => $department
        ], 201);
    }

    public function show(Department $department)
    {

        return response()->json([
            'message' => 'Department fetched successfully',
            'data' => $department
        ]);
    }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department->update($request->validated());

        return response()->json([
            'message' => 'Department updated successfully',
            'data' => $department
        ]);
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return response()->json([
            'message' => 'Department deleted successfully.'
        ]);
    }
}
