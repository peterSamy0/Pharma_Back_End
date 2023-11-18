<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use Illuminate\Http\Request;
use App\Http\Resources\PharmacyResourse;
use Illuminate\Support\Facades\Auth;


class WebPharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pharmacy = Pharmacy::paginate(10);
        // @dump( $pharmacy);
       $pharmacy = PharmacyResourse::collection($pharmacy , 200 );
       return view('dashboard' , ['pharmacies' => $pharmacy]);
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $pharmacy= Pharmacy::findOrFail($id);
            return view('Pharmacy.show', ['pharmacy' => $pharmacy ]);
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while retrieving the data.');
        }
    }
        // edit /////

        public function edit($id)
        {
            try {
                $pharmacy = Pharmacy::find($id);
                
                    // @dump($pharmacy);
                if ($pharmacy) {
                    return view('Pharmacy.edit', ['pharmacy' => $pharmacy]);
                } else {
                    return abort(403, 'You are not allowed to edit this pharmacy.');
                }
            } catch (\Exception $e) {
                return abort(500, 'An error occurred while retrieving the data.');
            }
            
        }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $pharmacy = Pharmacy::findOrFail($id);
        
            $pharmacy->update([
                'street' => $request->input('street'),
                'opening' => $request->input('opening'),
                // Add other fields as needed
            ]);
        
            return back()->with('success', 'Pharmacy updated successfully.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return back()->with('error', 'Pharmacy not found.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while updating the pharmacy.');
        }
           
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
        
            $pharmacy = Pharmacy::findOrFail($id);
            $pharmacy->delete();
            
            return back()->with('success', 'Pharmacy deleted successfully.');
        
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while deleting the pharmacy.');
        }
    }

    public function approveAccount($id){
        $user = Auth::user();
        $pharmacy = Pharmacy::where('id', $id)->first();
        if ($user && $user->role === 'admin') {
            try {
                $pharmacy->update([
                    'admin_approval' => 'approved'
                ]);
                $pharmacies = Pharmacy::paginate(10);
                return view('dashboard' , ['pharmacies' => $pharmacies]);
            } catch (\Exception $e) {
                // Log any errors that occur during the update process
                \Log::error('Error updating admin_approval: ' . $e->getMessage());
                return response()->json('Failed to update admin_approval', 500);
            }
        }
        return abort(401, 'Unauthorized');  
    }


    public function rejectAccount($id){
        $user = Auth::user();
        $pharmacy = Pharmacy::where('id', $id)->first();
        if($user->role == 'admin'){
            $pharmacy->update([
                'admin_approval' => 'rejected'
            ]);
            // dd($pharmacy);
            $pharmacies = Pharmacy::paginate(10);
            return view('dashboard' , ['pharmacies' => $pharmacies]);
        }
        return abort(401, 'Unauthorized');
    }
    }

