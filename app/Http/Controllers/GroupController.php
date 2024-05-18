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
