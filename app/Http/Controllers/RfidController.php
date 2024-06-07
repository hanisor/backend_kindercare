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
   
           // Check if the RFID already exists
           if (Rfid::where('number', $validatedData['number'])->exists()) {
               return new JsonResponse([
                   'errors' => ['The RFID number already exists.']
               ], JsonResponse::HTTP_CONFLICT);
           }
   
           // Create a new RFID instance
           $rfid = new Rfid;
           $rfid->number = $validatedData['number'];
           $rfid->save();
   
           // Return RFID in response
           return response([
               'rfid' => $rfid,
           ], 200);
   
       } catch (\Illuminate\Validation\ValidationException $e) {
           return new JsonResponse([
               'errors' => $e->validator->errors()->all()
           ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
       } catch (\Exception $e) {
           return new JsonResponse([
               'errors' => $e->getMessage()
           ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
       }
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

    public function getRfidForDoor($rfid_number)
    {
        // Retrieve the RFID by its number
        $rfid = Rfid::where('number', $rfid_number)->first();
    
        // Check if the RFID exists
        if ($rfid) {
            // Check if the RFID is associated with a guardian
            $guardian = Guardian::where('rfid_id', $rfid->id)->first();
    
            if ($guardian) {
                // Check if the guardian's status is active
                if ($guardian->status == 'ACTIVE') {
                    // RFID belongs to an active guardian, trigger action to open/close the door lock
                    // You can call a function here to control the door lock, for example:
                    // $this->controlDoorLock($guardian->door_lock_action);
                    // Assume 'door_lock_action' is a column in the guardian table specifying the action to perform
    
                    // For demonstration purposes, let's just return a message indicating the door lock action
                    return response()->json(['message' => 'Door lock action: ' . $guardian->door_lock_action], 200);
                } else {
                    // Guardian is not active
                    return response()->json(['message' => 'Guardian is not active'], 200);
                }
            } else {
                // RFID does not belong to any guardian
                return response()->json(['message' => 'RFID does not belong to any guardian'], 200);
            }
        } else {
            // RFID not found
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
