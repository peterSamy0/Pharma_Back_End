<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use Illuminate\Http\Request;
use App\Http\Resources\PharmacyResourse;
use App\Http\Requests\PharmacyRequest;

class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $pharmacy = Pharmacy::all();
    return PharmacyResourse::collection($pharmacy , 200 );
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PharmacyRequest $request)
    {
        $validated = $request->validated();
        $pharmacy= Pharmacy::create($request->all());
        return  new PharmacyResourse($pharmacy , 201);
    }


    /**
     * Display the specified resource.
     */
        public function show(Pharmacy $pharmacy)
    {   
        return new PharmacyResourse($pharmacy , 200);  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( PharmacyRequest $request, Pharmacy $pharmacy)
    {   
        $validated = $request->validated();
        $pharmacy->update($request->all());
        return new PharmacyResourse ($pharmacy , 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pharmacy $pharmacy)
    {
        $pharmacy->delete();
        return " Delete the pharmacy is Done";
    }
}
