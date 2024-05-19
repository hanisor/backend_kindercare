<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Rfid;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRfidRequest;
use App\Http\Requests\UpdateRfidRequest;
use Illuminate\Auth\RequestGuard;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\QueryException;
use App\Models\Guardian;


class RfidController extends Controller
{

    // Add rfid
    public function addRfid(Request $request)
    {
        try {
            // Validate fields
            $validatedData = $request->validate([
            'number' => 'required|string',
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return new JsonResponse([
                'errors' => $e->validator->errors()->all()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Create a new child instance
        $rfid = new Rfid;

        // Assign values from the request to the child object
        $rfid->number = $validatedData['number'];
  
        // Save the child to the database
        $rfid->save();
        // Return user & token in response
        return response([
            'rfid' => $rfid,
        ], 200);
    }

    public function getRfid()
    {
        // Retrieve the RFID numbers that are not associated with any guardian
        $rfids = Rfid::leftJoin('guardians', 'rfids.id', '=', 'guardians.rfid_id')
                    ->whereNull('guardians.rfid_id')
                    ->select('rfids.*')
                    ->get();
        
        return response()->json($rfids);
    }

    
    public function getRfidName($rfid_id)
    {
        // Retrieve the RFID by its ID
        $rfid = Rfid::find($rfid_id);

        // Check if the RFID exists
        if ($rfid) {
            return response()->json(['number' => $rfid->number], 200);
        } else {
            return response()->json(['message' => 'RFID not found'], 404);
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
    public function store(StoreRfidRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Rfid $rfid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rfid $rfid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRfidRequest $request, Rfid $rfid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rfid $rfid)
    {
        //
    }
}
