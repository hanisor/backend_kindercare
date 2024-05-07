<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Caregiver;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCaregiverRequest;
use App\Http\Requests\UpdateCaregiverRequest;
use Illuminate\Support\Facades\Auth; // import the Auth facade
use Illuminate\Auth\RequestGuard;
use Illuminate\Http\JsonResponse;


class CaregiverController extends Controller
{

    // Register user
    public function registerCaregiver(Request $request)
    {
        try {
            // Validate fields
            $attrs = $request->validate([
            'name' => 'nullable|string',
            'ic_number' => 'nullable|string|unique:caregivers',
            'phone_number' => 'nullable|string|unique:caregivers',
            'email' => 'required|string|email|unique:caregivers',
            'username' => 'required|string',
            'password' => 'required|string|min:6',
            'status' => 'required|string',
            'role' => 'required|string',
            'image' => 'nullable|image', // Allow the image field to be optional
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return new JsonResponse([
                'errors' => $e->validator->errors()->all()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Create user
        $caregiver = Caregiver::create([
            'name' => $attrs['name'],
            'ic_number' => $attrs['ic_number'],
            'phone_number' => $attrs['phone_number'],
            'email' => $attrs['email'],
            'username' => $attrs['username'],
            'password' => bcrypt($attrs['password']),
            'image' => $request->file('image') ? $request->file('image')->store('images') : null,
            'status' => 'ACTIVE', // Fixed value
            'role' => 'CAREGIVER',
        ]);

        // Return user & token in response
        return response([
            'caregiver' => $caregiver,
            'token' => $caregiver->createToken('kiddy')->plainTextToken
        ], 200);
    }

   // Login caregiver
   public function login(Request $request)
   {
       // validate fields
       $attrs = $request->validate([
        'email' => 'required|string',
        'password' => 'required|min:6',
       ]);

       // Attempt to authenticate the user
       if (!Auth::guard('caregiver')->attempt($attrs)) {
           return response([
               'message' => 'Invalid credentials.'
           ], 403);
       }

       // If the authentication is successful, return user and token
       $user = Auth::guard('caregiver')->user();
       $token = $user->createToken('kiddy')->plainTextToken;

       return response([
           'user' => $user,
           'token' => $token
       ], 200);
   }


   public function logout(Request $request)
   {
       // Revoke all tokens for the authenticated user using the 'caregiver' guard
       auth()-> guard('caregiver')->user()->tokens()-> delete();

       return response([
           'message' => 'Logout success.'
       ],200);
   }

   public function UserData($id)
   {
       // Retrieve the user by their ID
       $caregiver = Caregiver::find($id);

       // Check if the user exists
       if ($caregiver) {
           return response([
               'caregiver' => $caregiver,
               'message' => 'Successfully receiving data'
           ], 200);
       }
   }

   public function updateCaregiver(Request $request, $id)
    {
        try {
            // retrieve the user by ID
            $caregiver = Caregiver::find($id);

            // check if the user exists
            if (!$caregiver) {
                return response()->json(['message' => 'User not found'], 404);
            }

            // validate the request data
            $validatedData = $request->validate([
                'name' => 'sometimes|required|string',
                'ic_number' => 'sometimes|required|string|unique:caregivers,ic_number,'.$id,
                'phone_number' => 'sometimes|required|string|unique:caregivers,phone_number,'.$id,
                'username' => 'sometimes|required|string',
                'email' => 'sometimes|required|string|unique:caregivers,email,'.$id,
                'image' => 'sometimes|nullable|image', // Allow the image field to be optional
                'status' => 'sometimes|required|string',
                // Add validation rules for other fields you want to update
            ]);

            // Update the user's attributes if they are provided in the request
            foreach ($validatedData as $key => $value) {
                if (!is_null($value)) {
                    $caregiver->$key = $value;
                }
            }

            // Save the changes to the database
            $caregiver->save();

            // Return a success response
            return response()->json(['message' => 'User updated successfully', 'caregiver' => $caregiver]);
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



   public function getCaregiver(){
       $caregivers = Caregiver::where ('status', 'ACTIVE')->get();
       return response()->json($caregivers);
   }

    public function getCaregiverByEmail(Request $request)
    {
        // Validate the email parameter
        $request->validate([
            'email' => 'required|email',
        ]);

        // Retrieve the caregiver by email
        $caregiver = Caregiver::byEmail($request->email)->first();

        // Check if the caregiver exists
        if (!$caregiver) {
            return response()->json(['message' => 'Caregiver not found'], 404);
        }

        // Return the caregiver
        return response()->json($caregiver);
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
   public function store(StoreCaregiverRequest $request)
   {
       //
   }

   /**
    * Display the specified resource.
    */
   public function show(Caregiver $caregiver)
   {
       //
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit(Caregiver $caregiver)
   {
       //
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(UpdateCaregiverRequest $request, Caregiver $caregiver)
   {
       //
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(Caregiver $caregiver)
   {
       //
   }
}
