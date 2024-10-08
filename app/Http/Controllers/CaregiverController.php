<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Password;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Caregiver;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCaregiverRequest;
use App\Http\Requests\UpdateCaregiverRequest;
use Illuminate\Support\Facades\Auth; // import the Auth facade
use Illuminate\Auth\RequestGuard;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Models\Guardian;


class CaregiverController extends Controller
{


    public function caregiverLogin(){
        return view('kindercare.template.pages.samples.sign-in');
    }

    public function caregiverRegistration(){
        return view('kindercare.template.pages.samples.sign-up');
    }
 
    // Register user
     public function registerAppCaregiver(Request $request)
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
            'status' => 'ACTIVE', // Fixed value
            'role' => 'CAREGIVER',
        ]);

        // Return user & token in response
        return response([
            'caregiver' => $caregiver,
            'token' => $caregiver->createToken('kiddy')->plainTextToken
        ], 200);
        return view('caregiver-register');

    } 

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
            'remember_token' => 'nullable|string', 
        ]);

         // Assign default values for status and role
         $attrs['status'] = 'ACTIVE';
         $attrs['role'] = 'CAREGIVER';

        // Create user
        $caregiver = Caregiver::create([
            'username' => $attrs['username'],
            'email' => $attrs['email'],
            'password' => bcrypt($attrs['password']),
            'status' => 'ACTIVE', // Fixed value
            'role' => 'CAREGIVER',
            'remember_token' => null, // Explicitly set remember_token to null
        ]);

        // Redirect user after successful registration
        return redirect(route('signin'))->with("success", "Registration successful. You can now log in.");
    } catch (\Illuminate\Validation\ValidationException $e) {
        return new JsonResponse([
            'errors' => $e->validator->errors()->all()
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }
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

   
  // Login caregiver
 public function loginApp(Request $request)
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
    $user = auth()->guard('caregiver')->user();

    if ($user) {
        // Revoke all tokens for the authenticated user using the 'caregiver' guard
        $user->tokens()->delete();

        return response()->json([
            'message' => 'Logout success.'
        ], 200);
    }

    return response()->json([
        'message' => 'No authenticated user found.'
    ], 401);
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

   public function getCaregiver(){
        $caregivers = Caregiver::where ('status', 'ACTIVE')->get();
        return response()->json($caregivers);
    }

    public function getCaregiverCount() {
        // Query to get counts by timeslot
        $caregiverCounts = DB::table('groups')
            ->join('caregivers', 'groups.caregiver_id', '=', 'caregivers.id')
            ->select('groups.time', DB::raw('count(caregivers.id) as caregiver_count'))
            ->where('caregivers.status', 'ACTIVE')
            ->groupBy('groups.time')
            ->get();
    
        // Query to get total count of active caregivers
        $totalCaregiverCount = DB::table('caregivers')
            ->where('status', 'ACTIVE')
            ->count();
    
        // Return JSON response with both counts
        return response()->json([
            'caregiverCountsByTime' => $caregiverCounts,
            'totalCaregiverCount' => $totalCaregiverCount
        ]);
    }
    
    public function getCaregiverByChildren($guardian_id)
    {
        try {
            // Validate the input
            $guardian = Guardian::find($guardian_id);
            if (!$guardian) {
                return response()->json(['message' => 'Invalid guardian ID'], 404);
            }
    
            // Fetch the children associated with the guardian
            $children = DB::table('children')->where('guardian_id', $guardian_id)->pluck('id');
    
            // Fetch the groups associated with the children
            $groups = DB::table('child_groups')->whereIn('child_id', $children)->pluck('group_id');
    
            // Fetch the caregivers associated with these groups
            $caregivers = Caregiver::select('caregivers.*')
                ->join('groups', 'caregivers.id', '=', 'groups.caregiver_id')
                ->whereIn('groups.id', $groups)
                ->where('caregivers.status', 'active') // Add condition for active status
                ->get();
    
            // Check if caregivers are found
            if ($caregivers->isEmpty()) {
                return response()->json(['message' => 'No caregivers found for the provided guardian ID'], 404);
            }
    
            // Return the caregivers data in response
            return response()->json(['caregivers' => $caregivers], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch caregivers', 'error' => $e->getMessage()], 500);
        }
    }
    


    

    public function getCaregiverName($caregiver_id)
    {
        // Retrieve the guardian by its ID
        $caregiver = Caregiver::find($caregiver_id);

        // Check if the guardian exists
        if ($caregiver) {
            return response()->json(['caregiverUsername' => $caregiver->username], 200);
        } else {
            return response()->json(['message' => 'caregiver username not found'], 404);
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
            return response()->json(['message' => 'caregiver not found'], 404);
        }

        // Return the guardian
        return response()->json($caregiver);
    }

    // Update caregiver status
    public function updateCaregiverStatus(Request $request, $id)
    {
        // validate the request data
        $request->validate([
            'status' => 'required|in:INACTIVE', // Update the validation rule to require and only accept 'Taken'
            // Add validation rules for other fields you want to update
        ]);

        // retrieve the sickness record by ID
        $caregiver = Caregiver::find($id);

        // check if the sickness record exists
        if (!$caregiver) {
            return response()->json(['message' => 'Caregiver record not found'], 404);
        }

        // Update the status field
        $caregiver->status = $request->input('status');

        // Save the changes to the database
        $caregiver->save();

        // Return a success response
        return response()->json(['message' => 'caregiver record updated successfully', 'caregiver' => $caregiver]);
    }


    
    /**
     * Display a listing of the resource.
     */
/*     public function index()
    {
        return view('caregiver-register');
    } */

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
