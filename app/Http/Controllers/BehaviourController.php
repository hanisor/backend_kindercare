<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Behaviour;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBehaviourRequest;
use App\Http\Requests\UpdateBehaviourRequest;
use App\Models\ChildGroup;


class BehaviourController extends Controller
{
     // Add sickness
     public function addBehaviour(Request $request)
     {
         try {
             // Validate fields
             $validatedData = $request->validate([
                 'type' => 'required|string',
                 'description' => 'required|string',
                 'date_time' => 'required|date_format:Y-m-d H:i:s',
                 'child_id' => 'required|exists:children,id'
             ]);

            } catch (\Illuminate\Validation\ValidationException $e) {
                return new JsonResponse([
                    'errors' => $e->validator->errors()->all()
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
 
             // Create a new sickness instance
             $behaviour = new Behaviour;
 
             // Assign values from the request to the sickness object
             $behaviour->type = $validatedData['type'];
             $behaviour->description = $validatedData['description'];
             $behaviour->date_time = $validatedData['date_time'];
             $behaviour->child_id = $validatedData['child_id'];
 
             // Save the sickness to the database
             $behaviour->save();
 
          // Return user & token in response
            return response([
                'behaviour' => $behaviour,
            ], 200);
        }

        public function getChildBehavioursFromCaregiverId($caregiver_id)
        {
            try {
                // Retrieve the child group associated with the caregiver ID
                $childGroup = ChildGroup::whereHas('group', function($query) use ($caregiver_id) {
                        $query->where('caregiver_id', $caregiver_id);
                    })
                    ->with('child.behaviours') // Eager load the child and their behaviours
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
    public function store(StoreBehaviourRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Behaviour $behaviour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Behaviour $behaviour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBehaviourRequest $request, Behaviour $behaviour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Behaviour $behaviour)
    {
        //
    }
}
