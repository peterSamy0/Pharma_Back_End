<?php

namespace App\Http\Controllers;

use App\Models\Pharmacies;
use Illuminate\Http\Request;
use App\Http\Resources\PhamaciesResourse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $pharmacy = Pharmacies::all();
    return PhamaciesResourse::collection($pharmacy , 200 );
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all() , [
            "name" => "required",
            "password" => "required",
            "email" => "unique:pharmacies",  
            "image" => "required",
            "licence_number" => "unique:pharmacies",
            "bank_account" => "unique:pharmacies",    
            "Governorate" => "required",
            "city" => "required",
            "street" => "required",  
            "opening" => "required",
            "closing" => "required",  
        ]);

        if($validator->fails()){
            return response($validator->errors()->all() , 422);
        }

        $pharmacy= Pharmacies::create($request->all());
        return  new PhamaciesResourse($pharmacy , 201);
    }

   
   


    /**
     * Display the specified resource.
     */
        public function show(Pharmacies $pharmacy)
    {   
        return new PhamaciesResourse($pharmacy , 200);  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pharmacies $pharmacy)
    {
        $validator = Validator::make($request->all() , [
            "name" => "required",
            "password" => "required",
            "email" =>  [Rule::unique('pharmacies')->ignore($pharmacy)],
            "image" => "required",
            "licence_number" =>  [Rule::unique('pharmacies')->ignore($pharmacy)],
            "bank_account" => [Rule::unique('pharmacies')->ignore($pharmacy)],    
            "Governorate" => "required",
            "city" => "required",
            "street" => "required",  
            "opening" => "required",
            "closing" => "required",  
        ]);

        if($validator->fails()){
            return response ($validator->errors()->all() , 422);
        }

        $pharmacy->update($request->all());
        return new PhamaciesResourse ($pharmacy , 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pharmacies $pharmacy)
    {
        $pharmacy->delete();
        return " Delete the pharmacy is Done";
    }
}
