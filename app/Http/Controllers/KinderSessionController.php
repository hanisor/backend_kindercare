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
        ]);

        // Create a new KinderSession instance
        $kinderSession = new KinderSession;

        // Assign values from the request to the KinderSession object
        $kinderSession->year = $validatedData['year'];

        // Save the KinderSession to the database
        $kinderSession->save();

        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Session added successfully',
            'kinderSession' => $kinderSession,
        ], 200);
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Handle validation errors
        return response()->json([
            'success' => false,
            'errors' => $e->validator->errors()->all()
        ], 422);
    }
}

public function getYearById($id)
    {
        $session = KinderSession::find($id);

        if ($session) {
            return response()->json(['year' => $session->year]);
        } else {
            return response()->json(['error' => 'Session not found'], 404);
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
