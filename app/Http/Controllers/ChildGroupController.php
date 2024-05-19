<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ChildGroup;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChildGroupRequest;
use App\Http\Requests\UpdateChildGroupRequest;
use App\Models\Group;


class ChildGroupController extends Controller
{

    public function addChildGroup(Request $request)
    {
        try {
            // Validate fields
            $validatedData = $request->validate([
                'child_id' => 'required|exists:children,id', // Check if child_id exists in the children table
                'group_id' => 'required|exists:groups,id', // Check if group_id exists in the relatives table
            ]);
        

            // Create a new child instance
            $childGroup = new ChildGroup;

            // Assign values from the request to the child object
            $childGroup->child_id = $validatedData['child_id'];
            $childGroup->group_id = $validatedData['group_id'];
            
            // Save the child to the database
            $childGroup->save();

         

            // Return success response
            return response()->json(['message' => 'Child and group added successfully'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return validation error response
            return response()->json(['errors' => $e->validator->errors()->all()], 422);
        } catch (\Exception $e) {
            // Return generic error response
            return response()->json(['message' => 'Failed to add child group', 'error' => $e->getMessage()], 500);
        }
    }

    public function getChildGroup($group_id)
    {
        // Retrieve the parent by their ID
        $group = Group::find($group_id);
    
        // Check if the parent exists
        if ($group) {
            try {
                $childGroup = ChildGroup::select(
                    'children.name', 
                    'children.my_kid_number',
                    'children.date_of_birth',
                    'children.gender',
                    'children.allergy',
                    'guardians.name as guardian_name' // Alias the guardian's name column
                    )
                ->join('children', 'children.id', '=', 'child_groups.child_id')
                ->join('groups', 'groups.id', '=', 'child_groups.group_id')
                ->leftJoin('guardians', 'guardians.id', '=', 'children.guardian_id') // Left join to get guardian's name
                ->where('child_groups.group_id', $group_id) // Add a condition to filter by group ID
                ->get();
    
                return response()->json(['child_group' => $childGroup], 200);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Failed to fetch child groups', 'error' => $e->getMessage()], 500);
            }
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
    public function store(StoreChildGroupRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ChildGroup $childGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChildGroup $childGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChildGroupRequest $request, ChildGroup $childGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChildGroup $childGroup)
    {
        //
    }
}
