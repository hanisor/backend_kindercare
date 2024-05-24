<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Guardian;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGuardianRequest;
use App\Http\Requests\UpdateGuardianRequest;
use Illuminate\Support\Facades\Auth; // import the Auth facade
use Illuminate\Auth\RequestGuard;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\QueryException;
use App\Models\Rfid; // Check if this import statement is present



class GuardianController extends Controller
{
    // Register user
    public function registerGuardian(Request $request)
    {
        try {
            // Validate fields
            $attrs = $request->validate([
            'name' => 'nullable|string',
            'ic_number' => 'nullable|string|unique:guardians',
            'phone_number' => 'nullable|string|unique:guardians',
            'email' => 'required|string|email|unique:guardians',
            'username' => 'required|string',
            'password' => 'required|string|min:6',
            'status' => 'nullable|string',
            'role' => 'nullable|string',
            'image' => 'nullable|image', // Allow the image field to be optional
            'rfid_id' => 'required|integer|exists:rfids,id'

            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return new JsonResponse([
                'errors' => $e->validator->errors()->all()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Create user
        $guardian = Guardian::create([
            'name' => $attrs['name'],
            'ic_number' => $attrs['ic_number'],
            'phone_number' => $attrs['phone_number'],
            'email' => $attrs['email'],
            'username' => $attrs['username'],
            'password' => bcrypt($attrs['password']),
            'image' => $request->file('image') ? $request->file('image')->store('images') : null,
            'status' => $attrs['status'],// Fixed value
            'role' =>  $attrs['role'],
            'rfid_id' => $attrs['rfid_id']
        ]);

         // Check if the guardian was successfully created
        if (!$guardian) {
            return response(['message' => 'Failed to create guardian'], 404);
        }

        // Return user & token in response
        return response([
            'guardian' => $guardian,
            'token' => $guardian->createToken('kiddy')->plainTextToken
        ], 200);
    }

    // Login guardian
    public function login(Request $request)
    {
        // validate fields
        $attrs = $request->validate([
            'email' => 'required|string',
            'password' => 'required|min:6',
           ]);
    
           // Attempt to authenticate the user
           if (!Auth::guard('guardian')->attempt($attrs)) {
               return response([
                   'message' => 'Invalid credentials.'
               ], 403);
           }

        // If the authentication is successful, return user and token
        $user = Auth::guard('guardian')->user();
        $token = $user->createToken('kindercare')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], 200);
    }


    public function logout(Request $request)
    {
        // Revoke all tokens for the authenticated user using the 'guardian' guard
        auth()-> guard('guardian')->user()->tokens()-> delete();

        return response([
            'message' => 'Logout success.'
        ],200);
    }

    public function UserData($id)
    {
        // Retrieve the user by their ID
        $guardian = Guardian::find($id);

        // Check if the user exists
        if ($guardian) {
            return response([
                'guardian' => $guardian,
                'message' => 'Successfully receiving data'
            ], 200);
        }
    }

    public function updateGuardian(Request $request, $id)
    {
        try {
            // retrieve the user by ID
            $guardian = Guardian::find($id);
    
            // check if the user exists
            if (!$guardian) {
                return response()->json(['message' => 'User not found'], 404);
            }
    
            // validate the request data
            $validatedData = $request->validate([
                'phone_number' => 'sometimes|required|string|unique:guardians,phone_number,'.$id,
                'username' => 'sometimes|required|string',
                'image' => 'sometimes|nullable|image', // Allow the image field to be optional
                'status' => 'sometimes|required|string',
                // Add validation rules for other fields you want to update
            ]);
    
            // Update the user's attributes if they are provided in the request
            foreach ($validatedData as $key => $value) {
                if (!is_null($value)) {
                    $guardian->$key = $value;
                }
            }
    
            // Save the changes to the database
            $guardian->save();
    
            // Return a success response
            return response()->json(['message' => 'User updated successfully', 'guardian' => $guardian]);
        } catch (ValidationException $exception) {
            // Handle validation errors
            return response()->json(['message' => $exception->getMessage()], 422);
        } catch (QueryException $exception) {
            // Check if the exception is due to unique constraint violation
            if ($exception->errorInfo[1] === 1062) {
                return response()->json(['message' => 'Phone number already exists'], 422);
            }
            // Handle other types of database errors if needed
            return response()->json(['message' => 'Database error'], 500);
        }
    }
    

    public function getGuardian(){
        $guardians = Guardian::where ('status', 'ACTIVE')->get();
        return response()->json($guardians);
    }



    public function getGuardianName($guardian_id)
    {
        // Retrieve the guardian by its ID
        $guardian = Guardian::find($guardian_id);

        // Check if the guardian exists
        if ($guardian) {
            return response()->json(['guardianName' => $guardian->name], 200);
        } else {
            return response()->json(['message' => 'guardian name not found'], 404);
        }
    }

    
    public function getGuardianByEmail(Request $request)
    {
        // Validate the email parameter
        $request->validate([
            'email' => 'required|email',
        ]);

        // Retrieve the guardian by email
        $guardian = Guardian::byEmail($request->email)->first();

        // Check if the guardian exists
        if (!$guardian) {
            return response()->json(['message' => 'Guardian not found'], 404);
        }

        // Return the guardian
        return response()->json($guardian);
    }

    public function getGuardianByKeyword(Request $request)
    {
        // Check if the keyword parameter is provided in the URL
        if ($request->has('keyword')) {
            // Sanitize the keyword to prevent SQL injection
            $keyword = '%' . $request->input('keyword') . '%';

            // Query to select records that match the keyword and have status 'ACTIVE'
            $guardian = Guardian::where('name', 'like', $keyword)
                                ->where('status', 'ACTIVE')
                                ->get();
        } else {
            // If no keyword provided, select all records with status 'ACTIVE'
            $guardian = Guardian::where('status', 'ACTIVE')->get();
        }

        return response()->json($guardian);
    }

    public function updateGuardianStatus(Request $request, $id)
{
    // Validate the request data
    $request->validate([
        'status' => 'required|in:INACTIVE', // Update the validation rule to require and only accept 'INACTIVE'
        // Add validation rules for other fields you want to update
    ]);

    // Retrieve the guardian record by ID
    $guardian = Guardian::find($id);

    // Check if the guardian record exists
    if (!$guardian) {
        return response()->json(['message' => 'Guardian record not found'], 404);
    }

    // Update the guardian status
    $guardian->status = $request->input('status');
    
    // Save the changes to the database
    $guardian->save();

    // Update the status of all associated children to 'INACTIVE'
    if ($guardian->status === 'INACTIVE') {
        $guardian->children()->update(['status' => 'INACTIVE']);
    }

    // Return a success response
    return response()->json(['message' => 'Guardian record updated successfully', 'guardian' => $guardian]);
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
    public function store(StoreGuardianRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Guardian $guardian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guardian $guardian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGuardianRequest $request, Guardian $guardian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guardian $guardian)
    {
        //
    }
}
