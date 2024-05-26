<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ChildGroup;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChildGroupRequest;
use App\Http\Requests\UpdateChildGroupRequest;
use App\Models\Group;
use Illuminate\Support\Facades\Log;


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
                    'children.id',
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
                ->where('children.status', 'ACTIVE') // Add a condition to filter by children's status
                ->get();
    
                return response()->json(['child_group' => $childGroup], 200);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Failed to fetch child groups', 'error' => $e->getMessage()], 500);
            }
        }
    }

    public function getChildGroupbyChildId($child_id)
{
    // Retrieve the child group by the child ID
    $childGroup = ChildGroup::select(
        'children.id',
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
    ->where('child_groups.child_id', $child_id) // Corrected condition to filter by child ID
    ->where('children.status', 'ACTIVE') // Add a condition to filter by children's status
    ->get();

    return response()->json(['child_group' => $childGroup], 200);
}


    public function getChildGroupfromCaregiverId($caregiver_id)
    {
        // Retrieve the parent by their ID
        $group = Group::find($caregiver_id);
    
        // Check if the parent exists
        if ($group) {
            try {
                $childGroup = ChildGroup::select(
                    'children.id', 
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
                ->where('child_groups.group_id', $caregiver_id) // Add a condition to filter by group ID
                ->get();
    
                return response()->json(['child_group' => $childGroup], 200);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Failed to fetch child groups', 'error' => $e->getMessage()], 500);
            }
        }
    }

    public function getChildCountInGroups()
{
    $morningSessionCounts = Group::where('time', ['08:00 AM - 03:00 PM'])
                                 ->withCount('children')
                                 ->get()
                                 ->pluck('children_count');

    $afternoonSessionCounts = Group::where('time', ['02:00 PM - 06:00 PM'])
                                   ->withCount('children')
                                   ->get()
                                   ->pluck('children_count');

    $fullDaySessionCounts = Group::where('time', ['08:00 AM - 06:00 PM'])
                                 ->withCount('children')
                                 ->get()
                                 ->pluck('children_count');

    return response()->json([
        'morningSessionCounts' => $morningSessionCounts,
        'afternoonSessionCounts' => $afternoonSessionCounts,
        'fullDaySessionCounts' => $fullDaySessionCounts
    ]);
}

public function getChildGroupId(Request $request)
{
    try {
        // Validate fields
        $validatedData = $request->validate([
            'child_id' => 'required|exists:children,id', // Validate that child_id exists in children table
            'group_id' => 'required|exists:groups,id',   // Validate that group_id exists in groups table
        ]);

        // Debug print to log received parameters
        Log::debug("Received child_id: " . $validatedData['child_id']);
        Log::debug("Received group_id: " . $validatedData['group_id']);

        // Query the database to find the child group ID based on the provided child_id and group_id
        $childGroup = ChildGroup::where('child_id', $validatedData['child_id'])
                                ->where('group_id', $validatedData['group_id'])
                                ->first();

        // Debug print to log query results
        Log::debug("Child group query result: " . print_r($childGroup, true));

        if (!$childGroup) {
            return response()->json(['message' => 'Child group not found for the provided child ID and group ID'], 404);
        }

        // Return the child group ID in response
        return response()->json(['child_group_id' => $childGroup->id], 200);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return new JsonResponse([
            'errors' => $e->validator->errors()->all()
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Failed to fetch child group ID', 'error' => $e->getMessage()], 500);
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
