<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Note;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use Illuminate\Http\JsonResponse;
use App\Models\Guardian;
use App\Models\Caregiver;


class NoteController extends Controller
{
    // Add note
    public function addNote(Request $request)
    {
        try {
            // Validate fields
            $validatedData = $request->validate([
            'detail' => 'required|string',
            'date_time' => 'required|date_format:Y-m-d H:i:s',
            'status' => 'required|in:UNREAD,READ',
            'sender_type' => 'required|in:caregiver,parent',
            'guardian_id' => 'required|exists:guardians,id',
            'caregiver_id' => 'required|exists:caregivers,id'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return new JsonResponse([
                'errors' => $e->validator->errors()->all()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Create a new child instance
        $note = new Note;

        // Assign values from the request to the child object
        $note->detail = $validatedData['detail'];
        $note->date_time = $validatedData['date_time'];
        $note->status = $validatedData['status'];
        $note->sender_type = $validatedData['sender_type'];
        $note->guardian_id = $validatedData['guardian_id'];
        $note->caregiver_id = $validatedData['caregiver_id'];

        // Save the child to the database
        $note->save();

        // Redirect back after adding the child
        return redirect()->back()->with('success', 'Note added successfully.');
    }


    public function getNoteByGuardianId($guardian_id)
    {
        // Retrieve the parent by their ID
        $guardian = Guardian::find($guardian_id);

        // Check if the parent exists
        if ($guardian) {
            // Retrieve all note associated with this parent
            // $notes = $guardian->notes() (this notes is from model Guardian) ->get();
            $unreadNotes = $guardian->notes()->where('status', 'UNREAD')->get();

            return response()->json([
                'notes' => $unreadNotes,
                'message' => 'Unread note retrieved successfully'
            ], 200);
        } else {
            // If the parent does not exist, return an error message
            return response()->json([
                'message' => 'Guardian  not found'
            ], 404);
        }
    }

    public function getNoteByCaregiverId($caregiver_id)
    {
        // Retrieve the parent by their ID
        $caregiver = Caregiver::find($caregiver_id);

        // Check if the parent exists
        if ($caregiver) {
            // Retrieve all note associated with this caregiver
            // $notes = $guardian->notes() (this notes is from model Guardian) ->get();
            $unreadNotes = $caregiver->notes()->where('status', 'UNREAD')->get();

            return response()->json([
                'notes' => $unreadNotes,
                'message' => 'Unread note retrieved successfully'
            ], 200);
        } else {
            // If the parent does not exist, return an error message
            return response()->json([
                'message' => 'caregiver  not found'
            ], 404);
        }
    }

    public function getNotesByParent() {
        $notes = Note::where('status', 'UNREAD')
                     ->where('sender_type', 'parent')
                     ->with('guardian')
                     ->get();
    
        return response()->json($notes);
    }
    
     // Update note status
     public function updateNoteStatus(Request $request, $id)
     {
         // validate the request data
         $request->validate([
             'status' => 'required|in:READ', // Update the validation rule to require and only accept 'Taken'
             // Add validation rules for other fields you want to update
         ]);
 
         // retrieve the sickness record by ID
         $note = Note::find($id);
 
         // check if the sickness record exists
         if (!$note) {
             return response()->json(['message' => 'Notes record not found'], 404);
         }
 
         // Update the status field
         $note->status = $request->input('status');
 
         // Save the changes to the database
         $note->save();
 
         // Return a success response
         return response()->json(['message' => 'Note record updated successfully', 'note' => $note]);
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
    public function store(StoreNoteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        //
    }
}
