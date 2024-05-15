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

     // Add session
     public function addSession(Request $request)
     {
         try {
             // Validate fields
             $validatedData = $request->validate([
             'year' => 'required|integer',
             ]);
 
         } catch (\Illuminate\Validation\ValidationException $e) {
             return new JsonResponse([
                 'errors' => $e->validator->errors()->all()
             ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
         }
 
         // Create a new child instance
         $kinderSession = new KinderSession;
 
         // Assign values from the request to the child object
         $kinderSession->year = $validatedData['year'];
   
         // Save the child to the database
         $kinderSession->save();
         // Return user & token in response
         return response([
             'kinderSession' => $kinderSession,
         ], 200);
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
