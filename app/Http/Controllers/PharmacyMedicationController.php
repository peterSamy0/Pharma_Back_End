<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use Illuminate\Http\Request;
use App\Models\PharmacyMedication;
use App\Http\Resources\PharmacyMedicationResource;
use App\Http\Resources\CategoryMedicationsResource;

class PharmacyMedicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pharmacyMedication = PharmacyMedication::all();
        
        // dd($request->category_name);
        if($request->category){
            $filteredMedications = CategoryMedicationsResource::collection($pharmacyMedication)->filter(function ($item) use ($request) {
                
                return ($request->category_name && $item->id == $request->pharmacy_id);
            });
            return response()->json( CategoryMedicationsResource::collection($filteredMedications), 200);
        }
            return response()->json( PharmacyMedicationResource::collection($pharmacyMedication), 200);
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
