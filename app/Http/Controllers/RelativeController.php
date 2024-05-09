<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Relative;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRelativeRequest;
use App\Http\Requests\UpdateRelativeRequest;
use Illuminate\Http\JsonResponse;

class RelativeController extends Controller
{

    // Add Relative
    public function addRelative(Request $request)
    {
        try {   
            // Validate fields
            $validatedData = $request->validate([
            'name' => 'required|string',
            'relation' => 'required|string',
            'phone_number' => 'required|string',
            'date_time' => 'required|date_format:Y-m-d H:i:s',
            'status' => 'required|string',
            'guardian_id' => 'required|exists:guardians,id', // Ensure guardian_id exists in guardians table


            ]);

            // Create a new child instance
            $relative = new Relative;

            // Assign values from the request to the child object
            $relative->name = $validatedData['name'];
            $relative->relation = $validatedData['relation'];
            $relative->phone_number = $validatedData['phone_number'];
            $relative->date_time = $validatedData['date_time'];
            $relative->status = $validatedData['status'];
            $relative->guardian_id = $validatedData['guardian_id'];


            // Save the child to the database
            $relative->save();

             // Return success response
             return response()->json(['message' => 'relative added successfully', 'relative_id' => $relative->id], 200);
            } catch (\Illuminate\Validation\ValidationException $e) {
            // Return validation error response
            return response()->json(['errors' => $e->validator->errors()->all()], 422);
        } catch (\Exception $e) {
            // Return generic error response
            return response()->json(['message' => 'Failed to add relative', 'error' => $e->getMessage()], 500);
        }
    }

    public function getRelative($name){
        $relatives = Relative::where('name', $name)
                            ->get();
        return response()->json($relatives);
    }
    
    public function deleteRelative(Request $request, $id)
    {
        try {
            // Retrieve the relative by ID
            $relative = Relative::find($id);
    
            // Check if the relative exists
            if (!$relative) {
                return response()->json(['message' => 'Relative not found'], 404);
            }
    
            // Update the status to inactive
            $relative->status = 'INACTIVE'; // Assuming 'status' is the attribute to represent the status
            $relative->save();
    
            // Return a success response
            return response()->json(['message' => 'Relative soft deleted successfully']);
        } catch (Exception $exception) {
            // Handle exceptions
            return response()->json(['message' => $exception->getMessage()], 500);
        }
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
    public function store(StoreRelativeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Relative $relative)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Relative $relative)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRelativeRequest $request, Relative $relative)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Relative $relative)
    {
        //
    }
}
