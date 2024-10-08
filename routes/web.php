<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\CaregiverController;
use App\Http\Controllers\SicknessController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\RelativeController;
use App\Http\Controllers\ChildRelativeController;
use App\Http\Controllers\RfidController;
use App\Http\Controllers\KinderSessionController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ChildGroupController;
use App\Http\Controllers\BehaviourController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\ForgotPasswordController;


use App\Models\Guardian;
use App\Models\Child;
use App\Models\Caregiver;
use App\Models\Sickness;
use App\Models\Note;
use App\Models\Relative;
use App\Models\ChildRelative;
use App\Models\Rfid;
use App\Models\KinderSession;
use App\Models\Group;
use App\Models\ChildGroup;
use App\Models\Behaviour;
use App\Models\Performance;
use App\Models\Attendance;


Route::get('/', function(){
    return view('welcome');
});


Route::get('/caregiver-homepage', function(){
    return view('kindercare.template.index');
});

Route::get('/add-parent', function(){
    return view('kindercare.template.pages.forms.add-parent');
});

Route::get('/add-children', function(){
    return view('kindercare.template.pages.forms.add-children');
});

Route::get('/add-caregiver', function(){
    return view('kindercare.template.pages.forms.add-caregiver');
});

Route::get('/parent-table', function(){
    return view('kindercare.template.pages.tables.parent-table');
});

Route::get('/children-table', function(){
    return view('kindercare.template.pages.tables.children-table');
});

Route::get('/caregiver-table', function(){
    return view('kindercare.template.pages.tables.caregiver-table');
});

Route::get('/add-session', function(){
    return view('kindercare.template.pages.forms.add-session');
});

Route::get('/example-table', function(){
    return view('kindercare.template.pages.tables.basic-table');
});

Route::get('/example-form', function(){
    return view('kindercare.template.pages.forms.example');
});

Route::get('/attendance', function(){
    return view('kindercare.template.pages.tables.attendance');
});

Route::get('/add-rfid', function(){
    return view('kindercare.template.pages.forms.add-rfid');
});

Route::get('/buttons', function(){
    return view('kindercare.template.pages.ui-features.buttons');
});
Route::get('/typo', function(){
    return view('kindercare.template.pages.ui-features.typography');
});

// routes/web.php

Route::post('read_rfid', [RfidController::class, 'storerfid']);
Route::get('/rfid/latest', [RFIDController::class, 'fetch']);


Route::get('get-rfid-id/{rfid_id}', [RfidController::class, 'getRfidForDoor']);

// Guardian
// Register 
Route::post('api/guardian-register', [GuardianController::class, 'registerGuardian']);
// Login
Route::post('api/guardian-login', [GuardianController::class,'login']);

// Caregiver App
// Register 
Route::post('api/caregiver-register', [CaregiverController::class, 'registerAppCaregiver']);
// Login
Route::post('api/caregiver-login', [CaregiverController::class,'loginApp']);



// Caregiver Web
// Register 
Route::get('/caregiver-register', [CaregiverController::class, 'caregiverRegistration']) -> name('register');
Route::post('/caregiver-register', [CaregiverController::class,'registerCaregiver']) -> name ('register.post');


// Login
Route::get('/caregiver-login',  [CaregiverController::class, 'caregiverLogin']) -> name('signin');
Route::post('/caregiver-login-test', [CaregiverController::class, 'login'])->name('login.test');

Route::post('/api/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail']);
// Example of Laravel's built-in routes for password reset
Route::get('/api/password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])
    ->name('password.reset');
Route::post('/api/password/reset', [ForgotPasswordController::class, 'resetPassword']);




Route::prefix('api')->middleware(['auth:sanctum'])->group(function() {


    // Guardian
    Route::get('guardian-data', [GuardianController::class, 'getGuardian']);
    Route::get('guardian-byEmail', [GuardianController::class, 'getGuardianByEmail']);
    Route::get('guardian-byKeyword', [GuardianController::class, 'getGuardianByKeyword']);
    Route::get('guardian/get-guardianName/{guardian_id}', [GuardianController::class, 'getGuardianName']);
    Route::post('guardian-logout', [GuardianController::class, 'logout']);
    Route::put('guardian/update/{id}', [GuardianController::class,'updateGuardian']);
    Route::put('guardian/update-status/{id}', [GuardianController::class,'updateGuardianStatus']);

    // Children
    Route::get('child/by-guardianId/{guardian_id}', [ChildController::class, 'getChildrenByGuardianId']);
    Route::get('child-with-guardianName', [ChildController::class, 'getGuardianNameforChild']);
    Route::get('child-byId/{childId}', [ChildController::class, 'getChildById']);
    Route::post('add-child', [ChildController::class, 'add_child']);
    Route::put('child/update-status/{id}', [ChildController::class,'updateChildStatus']);
    Route::put('child/update-profile/{id}', [ChildController::class,'updateChild']);


    // Sickness
    Route::get('sickness/by-childId/{child_id}', [SicknessController::class, 'getSicknessbyChildId']);
    Route::get('sickness-data/{caregiver_id}', [SicknessController::class, 'getSickness']);
    Route::post('add-sickness', [SicknessController::class, 'addSickness']);
    Route::put('caregiver/update-sickness/{id}', [SicknessController::class,'updateSicknessStatus']);

    // Notes
    Route::get('note/by-guardianId/{guardian_id}', [NoteController::class, 'getNoteByGuardianId']);
    Route::get('note/by-caregiverId/{caregiver_id}', [NoteController::class, 'getNoteByCaregiverId']);
    Route::get('note/sendby-parent', [NoteController::class, 'getNotesByParent']);
    Route::get('note/sendby-caregiver', [NoteController::class, 'getNotesByCaregiver']);
    Route::post('guardian/add-note', [NoteController::class, 'addNote']);
    Route::put('note/update-status/{id}', [NoteController::class,'updateNoteStatus']);


    // Relative
    Route::get('child-relatives/{relative_id}', [ChildRelativeController::class, 'getChildRelative']);
    Route::get('relative/by-relativeName/{name}', [RelativeController::class, 'getRelative']);
    Route::get('childRelative-data', [ChildRelativeController::class, 'getAllChildRelative']);
    Route::post('guardian/add-relative', [RelativeController::class, 'addRelative']);
    Route::post('child_relative/relate', [ChildRelativeController::class, 'addChildRelative']);
    Route::put('relative/delete/{relative_id}', [RelativeController::class, 'deleteRelative']);

    // Caregiver
    // Route::get('caregiver-homepage',  [CaregiverController::class, 'index']) -> name('homepage');
    Route::get('caregiver-data', [CaregiverController::class, 'getCaregiver']);
    Route::get('caregiver-count', [CaregiverController::class, 'getCaregiverCount']);
    Route::get('caregiver-byEmail', [CaregiverController::class, 'getCaregiverByEmail']);
    Route::get('get-caregiverUsername/{caregiver_id}', [CaregiverController::class, 'getCaregiverName']);
    Route::put('caregiver/update-profile/{id}', [CaregiverController::class,'updateCaregiver']);
    Route::post('logout', [CaregiverController::class, 'logout']);
    Route::put('caregiver/update-status/{id}', [CaregiverController::class,'updateCaregiverStatus']);
    Route::get('get-caregiver/{guardian_id}', [CaregiverController::class, 'getCaregiverByChildren']);


    // Rfid
    Route::post('add-rfid', [RfidController::class, 'addRfid']);
    Route::get('get-rfid', [RfidController::class, 'getRfid']);
    Route::get('guardian-data', [GuardianController::class, 'getGuardian']);
    Route::get('get-rfid/{rfid_id}', [RfidController::class, 'getRfidName']);

    // Session
    Route::get('session-year', [KinderSessionController::class, 'getCurrentSession']);
    Route::post('add-session', [KinderSessionController::class, 'addSession']);


    // Group
    Route::get('child-group/time', [GroupController::class, 'getGroupIdByTimeSlot']);
    Route::get('caregiver-time', [GroupController::class, 'getCaregiverByTimeSlot']);
    Route::get('caregiver-groupid', [GroupController::class, 'getCaregiverIdByGroupId']);
    Route::get('groupid-time-caregiver', [GroupController::class, 'getGroupIds']);
    Route::post('get-group', [GroupController::class, 'getGroupIdByCaregiverId']); 
    Route::post('add-group', [GroupController::class, 'addGroup']);

    // Child Group
    Route::get('child-group/{group_id}', [ChildGroupController::class, 'getChildGroup']);
    Route::get('child-group/childId/{child_id}', [ChildGroupController::class, 'getChildGroupbyChildId']);
    Route::get('child-group/caregiverId/{caregiver_id}', [ChildGroupController::class, 'getChildGroupfromCaregiverId']);
    Route::get('child-group/caregiver', [ChildGroupController::class, 'getChildrenByCaregiver']);
    Route::get('child-by-group', [ChildGroupController::class, 'getChildIds']);
    Route::get('group-by-child', [ChildGroupController::class, 'getGroupIdByChildId']);
    Route::post('get-child-group-id', [ChildGroupController::class, 'getChildGroupId']);
    Route::get('get-child-group-time', [ChildGroupController::class, 'getChildGroupbytime']);
    Route::get('childgroup-count', [ChildGroupController::class, 'getChildCountInGroups']);
    Route::post('child-group', [ChildGroupController::class, 'addChildGroup']);
    Route::get('child-group/{caregiver_id}/{parent_id}', [ChildGroupController::class, 'getChildFromCaregiverId']);

    // Behaviour
    Route::get('behaviour/by-childId/{child_id}', [BehaviourController::class, 'getBehaviourByChildId']);
    Route::get('behaviour/{caregiver_id}', [BehaviourController::class, 'getChildBehavioursFromCaregiverId']);
    Route::post('add-behaviour', [BehaviourController::class, 'addBehaviour']);

    // Performance
    Route::get('performance/by-childId/{child_id}', [PerformanceController::class, 'getPerformanceByChildId']);
    Route::get('performance/{caregiver_id}', [PerformanceController::class, 'getChildPerformanceFromCaregiverId']);
    Route::post('add-performance', [PerformanceController::class, 'addPerformance']);


    // Attendance
    Route::get('attendance/{attendanceId}/childgroupid', [AttendanceController::class, 'getChildGroupId']);
    Route::post('attendance/child', [AttendanceController::class, 'getAttendancebyChildGroup']);
    Route::post('attendanceTable/child', [AttendanceController::class, 'getAttendancebyChildGroupTable']);
    Route::post('attendance/all', [AttendanceController::class, 'getAllAttendance']);
    Route::post('add-attendance-arrival', [AttendanceController::class, 'addAttendanceArrival']);
    Route::post('add-attendance-departure', [AttendanceController::class, 'addAttendanceDeparture']);

});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
