<?php

namespace App\Http\Controllers;

use App\Models\Medication;
use Illuminate\Http\Request;
use App\Http\Resources\MedicationResource;
use App\Http\Requests\MedicationRequest;

class MedicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medications = Medication::all();
        return MedicationResource::collection($medications , 200 );
    } 

    /**
     * Store a newly created resource in storage.
     */
    public function store(MedicationRequest $request)
    {
        
        $validated = $request->validated();
        $medications= Medication::create($request->all());
        return  new MedicationResource ($medications , 201);
    }

    /**
     * Display the specified resource.
     */

    public function show(Medication $medication)
    {
        return new MedicationResource($medication , 200);
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MedicationRequest $request, Medication $medication)
    {
        $validated = $request->validated();
        $medication->update($request->all());
        return new MedicationResource ($medication , 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medication $medication)
    {
        $medication->delete();
        return "deleted this item done";
    }
}
