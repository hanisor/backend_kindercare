<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Sickness;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSicknessRequest;
use App\Http\Requests\UpdateSicknessRequest;
use Illuminate\Http\JsonResponse;
use App\Models\Child;
use App\Models\ChildGroup;


class SicknessController extends Controller
{

    // Add sickness
    public function addSickness(Request $request)
    {
        try {
            // Validate fields
            $validatedData = $request->validate([
                'type' => 'required|string',
                'dosage' => 'required|string',
                'date_time' => 'required|date_format:Y-m-d H:i:s',
                'status' => 'required|string',
                'child_id' => 'required|exists:children,id'
            ]);

            // Create a new sickness instance
            $sickness = new Sickness;

            // Assign values from the request to the sickness object
            $sickness->type = $validatedData['type'];
            $sickness->dosage = $validatedData['dosage'];
            $sickness->date_time = $validatedData['date_time'];
            $sickness->status = $validatedData['status'];
            $sickness->child_id = $validatedData['child_id'];

            // Save the sickness to the database
            $sickness->save();

            // Return a success response
            return response()->json(['message' => 'Sickness added successfully'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->validator->errors()->all()], 422);
        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json(['error' => 'An error occurred while adding sickness'], 500);
        }
    }

    // Get sickness by child Id
    public function getSicknessbyChildId($child_id)
    {
        // Retrieve the parent by their ID
        $child = Child::find($child_id);

        // Check if the parent exists
        if ($child) {
            // Retrieve all children associated with this parent
            $sicknesses = $child->sicknesses()->where('status', 'Pending')->get();

            return response()->json([
                'sicknesses' => $sicknesses,
                'message' => 'Sickness retrieved successfully'
            ], 200);
        } else {
            // If the parent does not exist, return an error message
            return response()->json([
                'message' => 'Sickness not found'
            ], 404);
        }
    }

    

    // Update sickness status
    public function updateSicknessStatus(Request $request, $id)
    {
        // validate the request data
        $request->validate([
            'status' => 'required|in:Taken', // Update the validation rule to require and only accept 'Taken'
            // Add validation rules for other fields you want to update
        ]);

        // retrieve the sickness record by ID
        $sickness = Sickness::find($id);

        // check if the sickness record exists
        if (!$sickness) {
            return response()->json(['message' => 'Sickness record not found'], 404);
        }

        // Update the status field
        $sickness->status = $request->input('status');

        // Save the changes to the database
        $sickness->save();

        // Return a success response
        return response()->json(['message' => 'Sickness record updated successfully', 'sickness' => $sickness]);
    }

    public function getSickness($caregiver_id)
        {
            try {
                // Retrieve the child group associated with the caregiver ID
                $childGroup = ChildGroup::whereHas('group', function($query) use ($caregiver_id) {
                        $query->where('caregiver_id', $caregiver_id);
                    })
                    ->with('child.sicknesses') // Eager load the child and their behaviours
                    ->get();
        
                return response()->json(['child_group' => $childGroup], 200);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Failed to fetch child groups and behaviours', 'error' => $e->getMessage()], 500);
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
    public function store(StoreSicknessRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Sickness $sickness)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sickness $sickness)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSicknessRequest $request, Sickness $sickness)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sickness $sickness)
    {
        //
    }
}
