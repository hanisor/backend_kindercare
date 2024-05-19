<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Group;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;

class GroupController extends Controller
{

    public function addGroup(Request $request)
    {
        try {
            // Validate fields
            $validatedData = $request->validate([
                'session_id' => 'required|integer|exists:kinder_sessions,id',
                'caregiver_id' => 'required|integer|exists:caregivers,id',
                'time' => 'required|string', // Assuming the time range will be provided as a string
            ]);
    
            // Create a new Group instance
            $group = new Group;
    
            // Assign values from the request to the Group object
            $group->session_id = $validatedData['session_id'];
            $group->caregiver_id = $validatedData['caregiver_id'];
            $group->time = $validatedData['time']; // Save the time range as provided
    
            // Save the Group to the database
            $group->save();
    
            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'Group added successfully',
                'group' => $group,
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'success' => false,
                'errors' => $e->validator->errors()->all()
            ], 422);
        }
    }


    public function getGroupIdByTimeSlot(Request $request)
    {
        try {
            // Validate fields
            $validatedData = $request->validate([
                'time' => 'required|string', // Validate the time slot
            ]);
    
            // Query the database to find the group ID based on the provided time slot
            $group_id = Group::where('time', $validatedData['time'])->value('id');
    
            if (!$group_id) {
                return response()->json(['message' => 'Group not found for the provided time slot'], 404);
            }
    
            // Return the group ID in response
            return response()->json(['group_id' => $group_id], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return new JsonResponse([
                'errors' => $e->validator->errors()->all()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch group ID', 'error' => $e->getMessage()], 500);
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
    public function store(StoreGroupRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGroupRequest $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        //
    }
}
