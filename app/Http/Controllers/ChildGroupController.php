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
use Carbon\Carbon; // Make sure you import Carbon
use App\Models\Child;  // Import the Child model
use Illuminate\Support\Facades\DB;

class ChildGroupController extends Controller
{

    public function addChildGroup(Request $request)
    {
        try {
            // Validate fields
            $validatedData = $request->validate([
                'child_id' => 'required|exists:children,id',
                'time' => 'required', // Validate time slot input
            ]);

            // Retrieve the child's date of birth and calculate age
            $child = Child::findOrFail($validatedData['child_id']);
            $dob = Carbon::parse($child->date_of_birth);
            $currentYear = Carbon::now()->year;
            $age = $currentYear - $dob->year;

            // Debugging: Log the calculated age and time slot
            \Log::info('Calculated age: ' . $age);
            \Log::info('Time slot: ' . $validatedData['time']);

            // Retrieve the group based on age and time slot
            $group = Group::where('age', $age)
                          ->where('time', $validatedData['time'])
                          ->first();

            if (!$group) {
                return response()->json(['message' => 'No matching group found for the provided age and time slot'], 404);
            }

            // Create a new child-group relation
            $childGroup = new ChildGroup;
            $childGroup->child_id = $validatedData['child_id'];
            $childGroup->group_id = $group->id;
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

    public function getChildrenByCaregiver(Request $request)
    {
        try {
            // Validate the input
            $validatedData = $request->validate([
                'caregiver_id' => 'required|exists:caregivers,id',
            ]);

            $caregiverId = $validatedData['caregiver_id'];

            // Fetch the groups managed by the caregiver
            $groups = Group::where('caregiver_id', $caregiverId)->pluck('id');

            // Fetch the children associated with these groups
            $children = Child::select('children.*')
                ->join('child_groups', 'children.id', '=', 'child_groups.child_id')
                ->whereIn('child_groups.group_id', $groups)
                ->get();

            // Check if children are found
            if ($children->isEmpty()) {
                return response()->json(['message' => 'No children found for the provided caregiver ID'], 404);
            }

            // Return the children data in response
            return response()->json(['children' => $children], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->validator->errors()->all()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch children', 'error' => $e->getMessage()], 500);
        }
    }

    public function getGroupIdByChildId(Request $request)
{
    try {
        // Validate the input from the query parameter
        $request->validate([
            'child_id' => 'required|exists:children,id',
        ]);

        // Fetch the child_id from query parameters
        $child_id = $request->query('child_id');

        // Fetch the group IDs associated with the child
        $groupIds = DB::table('child_groups')->where('child_id', $child_id)->pluck('group_id');

        // Check if any group IDs are found
        if ($groupIds->isEmpty()) {
            return response()->json(['message' => 'No groups found for the provided child ID'], 404);
        }

        // Return the group IDs in response
        return response()->json(['group_ids' => $groupIds], 200);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(['errors' => $e->validator->errors()->all()], 422);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Failed to fetch group IDs', 'error' => $e->getMessage()], 500);
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

    public function getChildGroupByTime(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'time' => 'required'
        ]);
    
        try {
            // Retrieve the group IDs based on the provided time slot
            $groupIds = Group::where('time', $validatedData['time'])->pluck('id');
    
            if ($groupIds->isNotEmpty()) {
                // Fetch children in all groups that match the given time slot
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
                ->leftJoin('guardians', 'guardians.id', '=', 'children.guardian_id') // Left join to get guardian's name
                ->whereIn('child_groups.group_id', $groupIds) // Filter by group IDs
                ->where('children.status', 'ACTIVE') // Filter by children's status
                ->get();
    
                return response()->json(['child_group' => $childGroup], 200);
            } else {
                return response()->json(['message' => 'No groups found for the provided time slot'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch child groups', 'error' => $e->getMessage()], 500);
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

public function getChildIds(Request $request)
{
    try {
        // Validate the input
        $validatedData = $request->validate([
            'group_id' => 'required|exists:groups,id', // Ensure group_id is provided and exists
        ]);

        // Fetch child records based on group ID, eager load the guardian relationship
        $children = Child::whereHas('childGroups', function($query) use ($validatedData) {
            $query->where('group_id', $validatedData['group_id']);
        })
        ->where('status', 'ACTIVE') // Add condition to check for active status
        ->with('guardians')
        ->get();

        // Check if no children found
        if ($children->isEmpty()) {
            return response()->json(['message' => 'No children found for the given group'], 404);
        }

        // Transform the children data to include guardian's name
        $childrenData = $children->map(function($child) {
            return [
                'id' => $child->id,
                'name' => $child->name,
                'my_kid_number' => $child->my_kid_number,
                'gender' => $child->gender,
                'date_of_birth' => $child->date_of_birth,
                'allergy' => $child->allergy,
                'guardian_name' => $child->guardians->name, // Ensure guardians relationship is loaded
            ];
        });

        // Return the child records in response
        return response()->json(['children' => $childrenData], 200);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(['errors' => $e->validator->errors()->all()], 422);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Failed to fetch child records', 'error' => $e->getMessage()], 500);
    }
}

public function getChildGroupfromCaregiverId($caregiver_id)
{
// Retrieve the parent by their ID
$group = Group::find($caregiver_id);

    // Check if the parent exists
    if ($group) {
        try {
            $group = ChildGroup::select(
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

            return response()->json(['group' => $group], 200);
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
