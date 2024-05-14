<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\CaregiverController;
use App\Http\Controllers\SicknessController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\RelativeController;
use App\Http\Controllers\ChildRelativeController;


use App\Models\Guardian;
use App\Models\Child;
use App\Models\Caregiver;
use App\Models\Sickness;
use App\Models\Note;
use App\Models\Relative;
use App\Models\ChildRelative;

Route::get('/', function(){
    return view('welcome');
});


Route::get('/caregiver-homepage', function(){
    return view('kindercare.template.index');
});

Route::get('/add-parent', function(){
    return view('kindercare.template.pages.forms.add-parent');
});


// Guardian
// Register 
Route::post('api/guardian-register', [GuardianController::class, 'registerGuardian']);
// Login
Route::post('api/guardian-login', [GuardianController::class,'login']);

// Caregiver
// Register 
Route::get('/caregiver-register', [CaregiverController::class, 'caregiverRegistration']) -> name('register');
Route::post('/caregiver-register', [CaregiverController::class,'registerCaregiver']) -> name ('register.post');


// Login
Route::get('/caregiver-login',  [CaregiverController::class, 'caregiverLogin']) -> name('signin');
Route::post('/login', [CaregiverController::class,'login']) -> name ('login.post');



Route::prefix('api')->middleware(['auth:sanctum'])->group(function() {


    // Guardian
    Route::get('guardian-data', [GuardianController::class, 'getGuardian']);
    Route::get('guardian-byEmail', [GuardianController::class, 'getGuardianByEmail']);
    Route::get('guardian-byKeyword', [GuardianController::class, 'getGuardianByKeyword']);
    Route::post('guardian-logout', [GuardianController::class, 'logout']);
    Route::put('guardian/update/{id}', [GuardianController::class,'updateGuardian']);

    // Children
    Route::get('child/by-guardianId/{guardian_id}', [ChildController::class, 'getChildrenByGuardianId']);
    Route::post('add-child', [ChildController::class, 'add_child']);

    // Sickness
    Route::get('sickness/by-childId/{child_id}', [SicknessController::class, 'getSicknessbyChildId']);
    Route::get('sickness-data', [SicknessController::class, 'getSickness']);
    Route::post('add-sickness', [SicknessController::class, 'addSickness']);
    Route::put('caregiver/update-sickness/{id}', [SicknessController::class,'updateSicknessStatus']);

    // Notes
    Route::get('note/by-guardianId/{guardian_id}', [NoteController::class, 'getNoteByGuardianId']);
    Route::get('note/by-caregiverId/{caregiver_id}', [NoteController::class, 'getNoteByCaregiverId']);
    Route::get('note/sendby-parent', [NoteController::class, 'getNotesByParent']);
    Route::post('guardian/add-note', [NoteController::class, 'addNote']);
    Route::put('note/update-status/{id}', [NoteController::class,'updateNoteStatus']);


    // Relative
    Route::get('child-relatives/{relative_id}', [ChildRelativeController::class, 'getChildRelative']);
    Route::get('relative/by-relativeName/{name}', [RelativeController::class, 'getRelative']);
    Route::get('childRelative-data', [ChildRelativeController::class, 'getAllChildRelative']);
    Route::post('guardian/add-relative', [RelativeController::class, 'addRelative']);
    Route::post('child_relative/relate', [ChildRelativeController::class, 'addChildRelative']);
    Route::put('relative/delete/{guardian_id}', [RelativeController::class, 'deleteRelative']);

    // Caregiver
    // Route::get('caregiver-homepage',  [CaregiverController::class, 'index']) -> name('homepage');
    Route::get('caregiver-byEmail', [CaregiverController::class, 'getCaregiverByEmail']);
    Route::put('caregiver/update-profile/{id}', [CaregiverController::class,'updateCaregiver']);

    

});

