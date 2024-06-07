<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Attendance;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Models\ChildGroup;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{

    public function addAttendanceArrival(Request $request)
{
    try {
        // Validate fields
        $validatedData = $request->validate([
            'date_time_arrive' => 'required|date_format:Y-m-d H:i:s',
            'child_group_id' => 'required|exists:child_groups,id'
        ]);

        // Check if there is already an attendance record for this child group on the same day
        $existingAttendance = Attendance::where('child_group_id', $validatedData['child_group_id'])
            ->whereDate('date_time_arrive', now()->toDateString())
            ->first();

        if ($existingAttendance) {
            return response()->json(['message' => 'Attendance already recorded for this child group today'], 422);
        }

        // Create a new attendance instance
        $attendance = new Attendance;

        // Assign values from the request to the attendance object
        $attendance->date_time_arrive = $validatedData['date_time_arrive'];
        $attendance->child_group_id = $validatedData['child_group_id'];

        // Save the arrival time to the database
        $attendance->save();

        // Return a success response
        return response()->json(['message' => 'Arrival time added successfully'], 200);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(['errors' => $e->validator->errors()->all()], 422);
    } catch (\Exception $e) {
        // Handle other exceptions
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


public function addAttendanceDeparture(Request $request)
{
    try {
        // Validate fields
        $validatedData = $request->validate([
            'date_time_leave' => 'required|date_format:Y-m-d H:i:s',
            'child_group_id' => 'required|exists:child_groups,id'
        ]);

        // Retrieve child_id from child_group_id
        $childGroup = ChildGroup::findOrFail($validatedData['child_group_id']);
        $childId = $childGroup->child_id;

        // Ensure we are comparing dates correctly considering time zone
        $currentDate = now()->format('Y-m-d');

        // Log current date for debugging
        \Log::info("Current date for comparison: " . $currentDate);

        // Fetch the latest attendance record for the given child group
        $latestAttendance = Attendance::where('child_group_id', $validatedData['child_group_id'])
            ->whereDate('date_time_arrive', $currentDate)
            ->orderBy('date_time_arrive', 'desc')
            ->first();

        // Log the latest attendance fetched for debugging
        \Log::info("Latest attendance record: " . json_encode($latestAttendance));

        // Check if there's no arrival time recorded for today
        if (!$latestAttendance) {
            return response()->json(['message' => 'No arrival time recorded for this child group today'], 422);
        }

        // Check if a departure time is already recorded
        if ($latestAttendance->date_time_leave !== null) {
            return response()->json(['message' => 'Departure time already recorded for this child group today'], 422);
        }

        // Assign departure time to the latest attendance record
        $latestAttendance->date_time_leave = $validatedData['date_time_leave'];
        
        // Save the departure time to the database
        $latestAttendance->save();

        // Return a success response
        return response()->json(['message' => 'Departure time added successfully'], 200);
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Return validation errors
        return response()->json(['errors' => $e->validator->errors()->all()], 422);
    } catch (\Exception $e) {
        // Handle other exceptions
        \Log::error("Unexpected error: " . $e->getMessage()); // Log the error for debugging
        return response()->json(['error' => 'An unexpected error occurred. Please try again later.'], 500);
    }
}


    public function getAllAttendance(Request $request)
    {
        try {
            // Validate fields
            $validatedData = $request->validate([
                'caregiver_id' => 'required|exists:caregivers,id',
                'group_id' => 'required|exists:groups,id'
            ]);

            // Retrieve attendance records along with children data based on caregiver_id and group_id
            $attendances = Attendance::join('child_groups', 'attendances.child_group_id', '=', 'child_groups.id')
                            ->join('groups', 'child_groups.group_id', '=', 'groups.id')
                            ->join('children', 'child_groups.child_id', '=', 'children.id') // Correct join with children table
                            ->where('groups.caregiver_id', '=', $validatedData['caregiver_id'])
                            ->where('child_groups.group_id', '=', $validatedData['group_id'])
                            ->whereNull('attendances.date_time_leave') // Add condition for null departure time
                            ->orderBy('attendances.date_time_arrive', 'desc')
                            ->get([
                                'attendances.*',
                                'children.name as child_name',
                                'children.date_of_birth as child_dob',
                                'children.gender as child_gender',
                                'children.allergy as child_allergy'
                            ]);

            // Return the attendance records along with children data
            return response()->json(['attendances' => $attendances], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->validator->errors()->all()], 422);
        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getChildGroupId($attendanceId)
    {
        try {
            // Retrieve the child_group_id based on the attendance ID
            $childGroupId = Attendance::findOrFail($attendanceId)->child_group_id;
    
            // Return the child_group_id
            return response()->json(['child_group_id' => $childGroupId], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Attendance not found'], 404);
        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function getAttendancebyChildGroup(Request $request)
    {
        try {
            // Validate fields
            $validatedData = $request->validate([
                'child_group_id' => 'required|exists:child_groups,id',
            ]);
    
            // Retrieve the earliest attendance date for the specified child group
            $earliestAttendanceDate = Attendance::where('child_group_id', $validatedData['child_group_id'])
                ->orderBy('date_time_arrive')
                ->value('date_time_arrive');
    
            // If no attendance records found for the child group, consider them absent
            if (!$earliestAttendanceDate) {
                return response()->json(['message' => 'No attendance records found for the specified child group'], 200);
            }
    
            // Convert the earliest attendance date to a Carbon instance
            $earliestAttendanceDate = \Carbon\Carbon::parse($earliestAttendanceDate);
    
            // Create an array to hold attendance data for each day
            $attendanceByDay = [];
    
            // Loop through each day starting from the earliest attendance date up to today
            $currentDate = now();
            for ($date = $earliestAttendanceDate->copy(); $date->lte($currentDate); $date->addDay()) {
                // Retrieve attendance records for the current day
                $attendance = Attendance::join('child_groups', 'attendances.child_group_id', '=', 'child_groups.id')
                    ->join('children', 'child_groups.child_id', '=', 'children.id')
                    ->join('groups', 'child_groups.group_id', '=', 'groups.id') // Join with groups table
                    ->where('child_groups.id', '=', $validatedData['child_group_id'])
                    ->whereDate('attendances.date_time_arrive', $date->toDateString())
                    ->orderBy('attendances.date_time_arrive', 'desc')
                    ->get([
                        'attendances.*',
                        'children.name as child_name',
                        'children.date_of_birth as child_dob',
                        'children.gender as child_gender',
                        'children.allergy as child_allergy',
                        'groups.time as group_timeslot' // Select timeslot from groups table
                    ]);
    
                // If attendance record doesn't exist for the day, assume child is absent
                if ($attendance->isEmpty()) {
                    $attendanceByDay[$date->toDateString()] = 'Absent';
                } else {
                    // If attendance record exists, add it to the array
                    $attendanceByDay[$date->toDateString()] = $attendance;
                }
            }
    
            // Return the attendance records by day
            return response()->json(['attendance_by_day' => $attendanceByDay], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->validator->errors()->all()], 422);
        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    
    public function getAttendancebyChildGroupTable(Request $request)
{
    try {
        // Validate fields
        $validatedData = $request->validate([
            'child_group_id' => 'required|exists:child_groups,id',
            'date_time_arrive' => 'required|date',
        ]);
        
        // Parse the selected date
        $selectedDate = $validatedData['date_time_arrive'];

        // Get the list of children in the specified child group
        $children = DB::table('children')
            ->join('child_groups', 'children.id', '=', 'child_groups.child_id')
            ->where('child_groups.group_id', $validatedData['child_group_id'])
            ->select('children.id', 'children.name as child_name')
            ->get();

        // Initialize the attendance data structure
        $attendanceByDay = [];

        // Fetch attendance data for each child for the selected date
        foreach ($children as $child) {
            // Check if the child has an attendance record for the selected date
            $attendance = DB::table('attendances')
                ->where('child_group_id', $child->id) // Assuming the relationship is defined by 'child_group_id'
                ->whereDate('date_time_arrive', $selectedDate)
                ->first();


            if ($attendance) {
                // If attendance record exists, add it to the array
                $attendanceByDay[$selectedDate][] = [
                    'child_name' => $child->child_name,
                    'date_time_arrive' => $attendance->date_time_arrive,
                    'date_time_leave' => $attendance->date_time_leave,
                    // Include other attendance fields as needed
                ];
            } else {
                // If no attendance record, mark the child as absent
                $attendanceByDay[$selectedDate][] = [
                    'child_name' => $child->child_name,
                    'attendance' => 'Absent',
                ];
            }
        }
         // Return the attendance records by day
         return response()->json(['attendance_by_day' => $attendanceByDay], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->validator->errors()->all()], 422);
        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    



/* 
public function getAttendancebyChildGroup(Request $request)
{
    try {
        // Validate fields
        $validatedData = $request->validate([
            'child_group_id' => 'required|exists:child_groups,id',
            'date_time_arrive' => 'required|date',
        ]);
        
        // Parse the selected date
        $selectedDate = $validatedData['date_time_arrive'];

        // Get the list of children in the specified child group
        $children = DB::table('children')
            ->join('child_groups', 'children.id', '=', 'child_groups.child_id')
            ->where('child_groups.group_id', $validatedData['child_group_id'])
            ->select('children.id', 'children.name as child_name')
            ->get();

        // Initialize the attendance data structure
        $attendanceByDay = [];

        // Fetch attendance data for each child for the selected date
        foreach ($children as $child) {
            // Check if the child has an attendance record for the selected date
            $attendance = DB::table('attendances')
                ->where('child_group_id', $child->id) // Assuming the relationship is defined by 'child_group_id'
                ->whereDate('date_time_arrive', $selectedDate)
                ->first();


            if ($attendance) {
                // If attendance record exists, add it to the array
                $attendanceByDay[$selectedDate][] = [
                    'child_name' => $child->child_name,
                    'date_time_arrive' => $attendance->date_time_arrive,
                    'date_time_leave' => $attendance->date_time_leave,
                    // Include other attendance fields as needed
                ];
            } else {
                // If no attendance record, mark the child as absent
                $attendanceByDay[$selectedDate][] = [
                    'child_name' => $child->child_name,
                    'attendance' => 'Absent',
                ];
            }
        }

        // Return the attendance records by day
        return response()->json(['attendance_by_day' => $attendanceByDay], 200);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(['errors' => $e->validator->errors()->all()], 422);
    } catch (\Exception $e) {
        // Handle other exceptions
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
 */
    
    
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
    public function store(StoreAttendanceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
