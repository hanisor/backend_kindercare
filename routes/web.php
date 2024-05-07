<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\CaregiverController;
use App\Http\Controllers\SicknessController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\RelativeController;


use App\Models\Guardian;
use App\Models\Child;
use App\Models\Caregiver;
use App\Models\Sickness;
use App\Models\Note;
use App\Models\Relative;



Route::get('/', function () {
    return view('welcome');
});

// Guardian
// Register 
Route::post('api/guardian-register', [GuardianController::class, 'registerGuardian']);
// Login
Route::post('api/guardian-login', [GuardianController::class,'login']);

// Caregiver
// Register 
Route::post('api/caregiver-register', [CaregiverController::class, 'registerCaregiver']);

// Login
Route::post('api/caregiver-login', [CaregiverController::class,'login']);



Route::prefix('api')->middleware(['auth:sanctum'])->group(function() {

    Route::post('guardian-logout', [GuardianController::class, 'logout']);
    Route::get('guardian-data', [GuardianController::class, 'getGuardian']);
    Route::get('guardian-byEmail', [GuardianController::class, 'getGuardianByEmail']);
    Route::get('guardian-byKeyword', [GuardianController::class, 'getGuardianByKeyword']);
    Route::put('guardian/update/{id}', [GuardianController::class,'updateGuardian']);
    Route::get('child/by-guardianId/{guardian_id}', [ChildController::class, 'getChildrenByGuardianId']);
    Route::post('add-sickness', [SicknessController::class, 'addSickness']);
    Route::get('sickness/by-childId/{child_id}', [SicknessController::class, 'getSicknessbyChildId']);
    Route::post('guardian/add-note', [NoteController::class, 'addNote']);
    Route::get('note/by-guardianId/{guardian_id}', [NoteController::class, 'getNoteByGuardianId']);
    Route::post('guardian/add-relative', [RelativeController::class, 'addRelative']);
    Route::get('/relative/by-relativeName/{name}', [RelativeController::class, 'getRelative']);


});
// Caregiver 
// Register

Route::prefix('api')->middleware(['auth:sanctum'])->group(function() {

    // Update
    Route::put('caregiver/update-profile/{id}', [CaregiverController::class,'updateCaregiver']);
    Route::get('caregiver-email', [CaregiverController::class, 'getCaregiverByEmail']);
    Route::post('add-child', [ChildController::class, 'add_child']);
    Route::put('caregiver/update-sickness/{id}', [SicknessController::class,'updateSicknessStatus']);

});

