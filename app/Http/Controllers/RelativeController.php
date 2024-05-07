<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Relative;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRelativeRequest;
use App\Http\Requests\UpdateRelativeRequest;
use Illuminate\Http\JsonResponse;

class RelativeController extends Controller
{

    // Add Relative
    public function addRelative(Request $request)
    {
        try {
            // Validate fields
            $validatedData = $request->validate([
            'name' => 'required|string',
            'relation' => 'required|string',
            'phone_number' => 'required|string',
            'date_time' => 'required|date_format:Y-m-d H:i:s',
            'child_id' => 'required|exists:children,id'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return new JsonResponse([
                'errors' => $e->validator->errors()->all()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Create a new child instance
        $relative = new Relative;

        // Assign values from the request to the child object
        $relative->name = $validatedData['name'];
        $relative->relation = $validatedData['relation'];
        $relative->phone_number = $validatedData['phone_number'];
        $relative->date_time = $validatedData['date_time'];
        $relative->child_id = $validatedData['child_id'];

        // Save the child to the database
        $relative->save();

        // Redirect back after adding the child
        return redirect()->back()->with('success', 'relative added successfully.');
    }

    public function getRelative($name){
        $relatives = Relative::where('name', $name)
                            ->get();
        return response()->json($relatives);
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
    public function store(StoreRelativeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Relative $relative)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Relative $relative)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRelativeRequest $request, Relative $relative)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Relative $relative)
    {
        //
    }
}
