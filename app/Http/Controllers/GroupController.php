<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Group;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Caregiver;


class GroupController extends Controller
{

    public function addGroup(Request $request)
    {
        try {
            // Validate fields
            $validatedData = $request->validate([
                'session_id' => 'required|integer|exists:kinder_sessions,id',
                'caregiver_ids' => 'required|array',
                'caregiver_ids.*' => 'integer|exists:caregivers,id',
                'time' => 'required|string',
                'age' => 'required|integer',
            ]);

            $session_id = $validatedData['session_id'];
            $time = $validatedData['time'];
            $age = $validatedData['age'];

            $groups = [];

            foreach ($validatedData['caregiver_ids'] as $caregiver_id) {
                $groups[] = [
                    'session_id' => $session_id,
                    'caregiver_id' => $caregiver_id,
                    'time' => $time,
                    'age' => $age,
                    
                ];
            }

            // Insert multiple records at once
            Group::insert($groups);

            return response()->json([
                'success' => true,
                'message' => 'Groups added successfully',
                'groups' => $groups,
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->validator->errors()->all(),
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

    public function getCaregiverByTimeSlot(Request $request)
    {
        try {
            // Validate the input
            $validatedData = $request->validate([
                'time' => 'required|string',
            ]);

            // Fetch caregivers based on the time slot
            $caregivers = Caregiver::select('caregivers.*')
                ->join('groups', 'groups.caregiver_id', '=', 'caregivers.id')
                ->where('groups.time', $validatedData['time'])
                ->get();

            // Check if caregivers are found
            if ($caregivers->isEmpty()) {
                return response()->json(['message' => 'No caregivers found for the provided time slot'], 404);
            }

            // Return the caregivers in the response
            return response()->json(['caregivers' => $caregivers], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'errors' => $e->validator->errors()->all()
            ], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch caregivers', 'error' => $e->getMessage()], 500);
        }
    }

    public function getGroupIdByCaregiverId(Request $request)
{
    try {
        // Validate fields
        $validatedData = $request->validate([
            'caregiver_id' => 'required|exists:caregivers,id', // Validate that caregiver_id exists in caregivers table
        ]);

        // Query the database to find the group ID based on the provided caregiver ID
        $group_id = Group::where('caregiver_id', $validatedData['caregiver_id'])->value('id');

        if (!$group_id) {
            return response()->json(['message' => 'Group not found for the provided caregiver ID'], 404);
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

public function getGroupIds(Request $request)
{
    try {
        // Validate the input
        $validatedData = $request->validate([
            'time' => 'required|string',
              'caregiver_id' => 'nullable|exists:caregivers,id', // Caregiver ID is optional
        ]);

        // Fetch group IDs based on time slot and caregiver ID
        $groupsQuery = Group::where('time', $validatedData['time']);

        if (!empty($validatedData['caregiver_id'])) {
            $groupsQuery->where('caregiver_id', $validatedData['caregiver_id']);
        }

        $groupIds = $groupsQuery->pluck('id');

        // Debug: Log the group IDs
        \Log::info('Group IDs:', $groupIds->toArray());

        if ($groupIds->isEmpty()) {
            return response()->json(['message' => 'No groups found for the given time and caregiver'], 404);
        }

        // Return the group IDs in response
        return response()->json(['group_ids' => $groupIds], 200);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(['errors' => $e->validator->errors()->all()], 422);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Failed to fetch group IDs', 'error' => $e->getMessage()], 500);
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
