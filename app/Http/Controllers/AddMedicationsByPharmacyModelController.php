<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\addMedicationsByPharmacyModel;

class AddMedicationsByPharmacyModelController extends Controller
{

    function __construct(){
        $this->middleware('auth:sanctum');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medications = addMedicationsByPharmacyModel::all();
        return response()->json( $medications, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
        $user = Auth::user();
            $validateUser = Validator::make($request->all(), 
            [
                'category' => 'required',
                'price' => 'required',
                'medicineName' => 'required',
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images/Request', 'public');
            } else {
                $imagePath = null;
            }
            
            $addMedicationsByPharmacyModel = addMedicationsByPharmacyModel::create([
                'medicineName' => $request->medicineName,
                'category_id' => $request->category,
                'price' => $request->price,
                // 'image' =>  $imagePath,
                'user_id' => $user->id
            ]);
            return response()->json($addMedicationsByPharmacyModel, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(addMedicationsByPharmacyModel $addMedicationsByPharmacyModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, addMedicationsByPharmacyModel $addMedicationsByPharmacyModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(addMedicationsByPharmacyModel $addMedicationsByPharmacyModel)
    {
        //
    }
}
