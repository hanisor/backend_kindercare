<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Performance;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePerformanceRequest;
use App\Http\Requests\UpdatePerformanceRequest;
use App\Models\ChildGroup;

class PerformanceController extends Controller
{

     // Add Performance
     public function addPerformance(Request $request)
     {
         try {
             // Validate fields
             $validatedData = $request->validate([
                 'skill' => 'required|string',
                 'level' => 'required|string',
                 'date' => 'required|date',
                 'child_id' => 'required|exists:children,id'
             ]);

            } catch (\Illuminate\Validation\ValidationException $e) {
                return new JsonResponse([
                    'errors' => $e->validator->errors()->all()
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
 
             // Create a new sickness instance
             $performance = new Performance;
 
             // Assign values from the request to the sickness object
             $performance->skill = $validatedData['skill'];
             $performance->level = $validatedData['level'];
             $performance->date = $validatedData['date'];
             $performance->child_id = $validatedData['child_id'];
 
             // Save the sickness to the database
             $performance->save();
 
          // Return user & token in response
            return response([
                'performance' => $performance,
            ], 200);
        }

        public function getChildPerformanceFromCaregiverId($caregiver_id)
        {
            try {
                // Retrieve the child group associated with the caregiver ID
                $childGroup = ChildGroup::whereHas('group', function($query) use ($caregiver_id) {
                        $query->where('caregiver_id', $caregiver_id);
                    })
                    ->with('child.performances') // Eager load the child and their performances
                    ->get();
        
                return response()->json(['child_group' => $childGroup], 200);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Failed to fetch child groups and performances', 'error' => $e->getMessage()], 500);
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
    public function store(StorePerformanceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Performance $performance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Performance $performance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePerformanceRequest $request, Performance $performance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Performance $performance)
    {
        //
    }
}
