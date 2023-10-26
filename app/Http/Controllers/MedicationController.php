<?php

namespace App\Http\Controllers;

use App\Models\Medication;
use Illuminate\Http\Request;
use App\Http\Resources\MedicationResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all() , [
            "name" => "unique:medications",
            "price" => "required",
            "image" => "required",     
        ]);

        if($validator->fails()){
            return response($validator->errors()->all() , 422);
        }

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
    public function update(Request $request, Medication $medication)
    {
        $validator = Validator::make($request->all() , [

            "name" => [Rule::unique('medications')->ignore($medication)],
            "price" => "required",
            "image" =>  "required"
        ]);

        if($validator->fails()){
            return response ($validator->errors()->all() , 422);
        }

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
