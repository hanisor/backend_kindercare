<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\KinderSession;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKinderSessionRequest;
use App\Http\Requests\UpdateKinderSessionRequest;

class KinderSessionController extends Controller
{

    public function addSession(Request $request)
    {
        try {
            // Validate fields
            $validatedData = $request->validate([
                'year' => 'required|integer',
                'status' => 'required|in:Current,Pass',

            ]);
    
            // Create a new KinderSession instance
            $kinderSession = new KinderSession;
    
            // Assign values from the request to the KinderSession object
            $kinderSession->year = $validatedData['year'];
            $kinderSession->status = $validatedData['status'];

    
            // Save the KinderSession to the database
            $kinderSession->save();
    
            // Return the ID of the newly created session in the response
            return response()->json([
                'success' => true,
                'message' => 'Session added successfully',
                'sessionId' => $kinderSession->id, // Include the ID of the newly created session
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'success' => false,
                'errors' => $e->validator->errors()->all()
            ], 422);
        }
    }
    

    public function getCurrentSession()
    {
        $session = KinderSession::where('status', 'current')->first();
    
        if (!$session) {
            return response()->json(['error' => 'No current sessions found'], 404);
        } else {
            return response()->json([
                'sessionId' => $session->id,
                'year' => $session->year
            ]);
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
    public function store(StoreKinderSessionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(KinderSession $kinderSession)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KinderSession $kinderSession)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKinderSessionRequest $request, KinderSession $kinderSession)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KinderSession $kinderSession)
    {
        //
    }
}
