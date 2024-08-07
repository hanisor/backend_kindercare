<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Child;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChildRequest;
use App\Http\Requests\UpdateChildRequest;
use Illuminate\Http\JsonResponse;
use App\Models\Guardian;
use Illuminate\Support\Facades\Log;


class ChildController extends Controller
{

    public function add_child(Request $request)
{
    try {
        // Assuming you're validating the request data before processing it
        $validatedData = $request->validate([
            'name' => 'required|string',
            'my_kid_number' => 'required|string|unique:children',
            'date_of_birth' => 'required|string',
            'gender' => 'required|string',
            'allergy' => 'required|string',
            'status' => 'required|string',
            'guardian_id' => 'required|exists:guardians,id', // Ensure guardian_id exists in guardians table
        ]);

        // Create a new child instance
        $child = new Child;

        // Assign values from the request to the child object
        $child->name = $validatedData['name'];
        $child->my_kid_number = $validatedData['my_kid_number'];
        $child->date_of_birth = $validatedData['date_of_birth'];    
        $child->gender = $validatedData['gender'];
        $child->allergy = $validatedData['allergy'];
        $child->status = $validatedData['status'];
        $child->guardian_id = $validatedData['guardian_id'];

        // Save the child to the database
        $child->save();

        // Return success response
        return response()->json(['message' => $child], 201);
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Return validation error response
        return response()->json(['errors' => $e->validator->errors()->all()], 422);
    } catch (\Exception $e) {
        // Return generic error response
        return response()->json(['message' => 'Failed to add child', 'error' => $e->getMessage()], 500);
    }
}


public function getChildrenByGuardianId($guardian_id)
{
    // Retrieve the parent by their ID
    $guardian = Guardian::where('id', $guardian_id)
                ->where('status', 'ACTIVE')
                ->first();

    // Check if the parent exists
    if ($guardian) {
        // Retrieve all active children associated with this parent and join with child_groups, groups, and caregivers
        $children = $guardian->children()
            ->where('children.status', 'ACTIVE')
            ->join('child_groups', 'children.id', '=', 'child_groups.child_id')
            ->join('groups', 'child_groups.group_id', '=', 'groups.id')
            ->join('caregivers', 'groups.caregiver_id', '=', 'caregivers.id')
            ->select('children.*', 'groups.id as group_id', 'caregivers.name as caregiver_name')
            ->get();

        return response()->json([
            'children' => $children,
            'message' => 'Children retrieved successfully'
        ], 200);
    } else {
        // If the parent does not exist, return an error message
        return response()->json([
            'message' => 'Parent not found'
        ], 404);
    }
}

    public function getGuardianNameforChild(){
        // Retrieve children records with guardian's status ACTIVE and include the guardian's name
        $children = Child::join('guardians', 'children.guardian_id', '=', 'guardians.id')
                        ->where('guardians.status', 'ACTIVE')
                        ->where('children.status', 'ACTIVE')
                        ->select('children.*', 'guardians.name as guardian_name') // Adjust 'name' to your actual column name
                        ->get();
        
        return response()->json($children);
    }
    
    public function getChild(){
        // Retrieve children records where the associated guardian's status is ACTIVE
        $children = Child::join('guardians', 'children.guardian_id', '=', 'guardians.id')
                        ->where('guardians.status', 'ACTIVE')
                        ->where('chidlren.status', 'ACTIVE')
                        ->get();
        
        return response()->json($children);
    }
    
    public function getChildById($childId) {
        // Retrieve child record by child ID where the child's status is ACTIVE
        $child = Child::where('id', $childId)
                      ->where('status', 'ACTIVE')
                      ->first();
        
        if ($child) {
            return response()->json($child);
        } else {
            return response()->json(['message' => 'Child not found or inactive'], 404);
        }
    }
    
    

  public function updateChild(Request $request, $id)
{
    try {
        // Log incoming request data
        Log::info('Received update request for child ID: ' . $id);
        Log::info('Request Data: ', $request->all());

        // retrieve the child by ID
        $child = Child::find($id);

        // check if the child exists
        if (!$child) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // validate the request data
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string',
            'my_kid_number' => 'sometimes|required|string',
            'date_of_birth' => 'sometimes|required|string',
            'gender' => 'sometimes|required|string',
            'allergy' => 'sometimes|required|string',
            'status' => 'sometimes|required|string',
            // Add validation rules for other fields you want to update
        ]);

        // Log validated data
        Log::info('Validated Data: ', $validatedData);

        // Update the child's attributes if they are provided in the request
        foreach ($validatedData as $key => $value) {
            if (!is_null($value)) {
                $child->$key = $value;
            }
        }

        // Save the changes to the database
        $child->save();

        // Return a success response
        return response()->json(['message' => 'User updated successfully', 'child' => $child]);
    } catch (ValidationException $exception) {
        // Handle validation errors
        Log::error('Validation Error: ' . $exception->getMessage());
        return response()->json(['message' => $exception->getMessage()], 422);
    } catch (QueryException $exception) {
        // Check if the exception is due to unique constraint violation
        if ($exception->errorInfo[1] === 1062) {
            Log::error('Database Error: Phone number already exists');
            return response()->json(['message' => 'Phone number already exists'], 422);
        }
        // Handle other types of database errors if needed
        Log::error('Database Error: ' . $exception->getMessage());
        return response()->json(['message' => 'Database error'], 500);
    } catch (\Exception $exception) {
        // Handle unexpected errors
        Log::error('Unexpected Error: ' . $exception->getMessage());
        return response()->json(['message' => 'Unexpected error occurred'], 500);
    }
}

    /// Update child status
public function updateChildStatus(Request $request, $id)
{
    // validate the request data
    $request->validate([
        'status' => 'required|in:INACTIVE', // Update the validation rule to require and only accept 'INACTIVE'
        // Add validation rules for other fields you want to update
    ]);

    // retrieve the child record by ID
    $child = Child::find($id);

    // check if the child record exists
    if (!$child) {
        return response()->json(['message' => 'Child record not found'], 404);
    }

    // Update the status field
    $child->status = $request->input('status');

    // Save the changes to the database
    $child->save();

    // Return a success response
    return response()->json(['message' => 'Child record updated successfully', 'child' => $child]);
}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChildRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Child $child)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Child $child)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChildRequest $request, Child $child)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Child $child)
    {
        //
    }
}
