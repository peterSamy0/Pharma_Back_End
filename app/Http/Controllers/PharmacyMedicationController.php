<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use App\Models\PharmacyMedication;
use Illuminate\Http\Request;

class PharmacyMedicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $medications = $request->input('medicationsList');
        if($medications){
            foreach($medications as $medicine){
                PharmacyMedication::create([
                    'pharmacy_id' => $medicine['pharmacy_id'],
                    'medication_id' => $medicine['medicine_id']
                ]);
            };
        }
        return response()->json("add successfully", 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(PharmacyMedication $pharmacyMedication)
    {
        return response()->json($pharmacyMedication);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PharmacyMedication $pharmacyMedication)
    {
        $pharmacyMedication->delete();
        return response()->json("deleted successfully",200);
    }
}
