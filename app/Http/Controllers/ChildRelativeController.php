<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ChildRelative;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChild_RelativeRequest;
use App\Http\Requests\UpdateChild_RelativeRequest;
use Illuminate\Http\JsonResponse;


class ChildRelativeController extends Controller
{

    public function addChildRelative(Request $request)
    {
        try {
            // Validate fields
            $validatedData = $request->validate([
                'child_id' => 'required|exists:children,id', // Check if child_id exists in the children table
                'relative_id' => 'required|exists:relatives,id', // Check if relative_id exists in the relatives table
            ]);
        

            // Create a new child instance
            $childRelative = new ChildRelative;

            // Assign values from the request to the child object
            $childRelative->child_id = $validatedData['child_id'];
            $childRelative->relative_id = $validatedData['relative_id'];
            
            // Save the child to the database
            $childRelative->save();

         

            // Return success response
            return response()->json(['message' => 'Child Relative added successfully'], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return validation error response
            return response()->json(['errors' => $e->validator->errors()->all()], 422);
        } catch (\Exception $e) {
            // Return generic error response
            return response()->json(['message' => 'Failed to add child relative', 'error' => $e->getMessage()], 500);
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
    public function store(StoreChild_RelativeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Child_Relative $child_Relative)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Child_Relative $child_Relative)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChild_RelativeRequest $request, Child_Relative $child_Relative)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Child_Relative $child_Relative)
    {
        //
    }
}
