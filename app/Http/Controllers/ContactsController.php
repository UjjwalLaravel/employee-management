<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Employee;
use App\Http\Requests\StoreContactRequest;


class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($emp_id)
    {
        $contacts = Contact::where('employee_id', $emp_id)->get();
        if(count($contacts) == 0){
            return response()->json([
                'success' => true,
                'message' => 'No contact found for this employee',
                'data' => []
            ]);    
        }
        return response()->json([
            'success' => true,
            'message' => 'Contacts fetched successfully',
            'data' => $contacts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request, $emp_id)
    {
        if (!Employee::find($emp_id)) {
            return response()->json(['success' => false, 'message' => 'Employee not found'], 404);
        }

        $data = $request->validated();
        $data['employee_id'] = $emp_id;

        $contact = Contact::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Contact created successfully',
            'data' => $contact
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return response()->json(['success' => true, 'data' => $contact]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreContactRequest $request, Contact $contact)
    {
        $contact->update($request->validated());

        return response()->json(['success' => true, 'message' => 'Contact updated successfully', 'data' => $contact]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return response()->json(['success' => true, 'message' => 'Contact deleted successfully']);
    }
}
