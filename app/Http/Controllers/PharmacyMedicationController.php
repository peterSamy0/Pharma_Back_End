<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use Illuminate\Http\Request;
use App\Models\PharmacyMedication;
use App\Http\Resources\PharmacyMedicationResource;

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

    public function store(Request $request){
        $medications = $request->input('medicationsList');
        if ($medications) {
            foreach ($medications as $medicine) {
                PharmacyMedication::create([
                    'pharmacy_id' => $medicine['pharmacy_id'],
                    'medication_id' => $medicine['medication_id'],
                    'price' => $medicine['price']
                ]);
            }
        }
        return response()->json("add successfully", 200);
    }
    /**
     * Display the specified resource.
     */
    public function show(PharmacyMedication $pharmacyMedication)
    {
        return response()->json(new PharmacyMedicationResource($pharmacyMedication));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $pharmacyMedication = PharmacyMedication::findOrFail($id);
            // Perform the update operation
            
            $pharmacyMedication->update([
                'price'=> $request->price
            ]);
            
            return response()->json($pharmacyMedication, 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 400);
        }
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
