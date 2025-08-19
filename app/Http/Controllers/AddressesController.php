<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAddressRequest;

class AddressesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($emp_id)
    {
        $addresses = Address::where('employee_id', $emp_id)->get();
        if(count($addresses) == 0){
            return response()->json([
                'success' => true,
                'message' => 'No address found for this employee',
                'data' => []
            ]);    
        }
        return response()->json([
            'success' => true,
            'message' => 'Addresses fetched successfully',
            'data' => $addresses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAddressRequest $request, $emp_id)
    {
        if (!Employee::find($emp_id)) {
            return response()->json(['success' => false, 'message' => 'Employee not found'], 404);
        }

        $data = $request->validated();
        $data['employee_id'] = $emp_id;

        $address = Address::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Address created successfully',
            'data' => $address
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        return response()->json(['success' => true, 'data' => $address]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {
        $validated = $request->validate([
            'address_line1' => 'sometimes|string|max:255',
            'city' => 'sometimes|string|max:100',
            'state' => 'sometimes|string|max:100',
            'country' => 'sometimes|string|max:100',
            'pin_code' => 'sometimes|string|max:20',
        ]);

        $address->update($validated);

        return response()->json(['success' => true, 'message' => 'Address updated successfully', 'data' => $address]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        $address->delete();

        return response()->json(['success' => true, 'message' => 'Address deleted successfully']);
    }
}
