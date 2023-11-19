<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;
use App\Http\Resources\DeliveryResource;
use Illuminate\Support\Facades\Auth;

class WebDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $delivery = Delivery::paginate(10);
        // @dump( $delivery);
       $delivery = DeliveryResource::collection($delivery , 200 );
       return view('dashboard' , ['deliveries' => $delivery]);
       
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
            $delivery= Delivery::findOrFail($id);
            return view('Delivery.show', ['delivery' => $delivery ]);
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while retrieving the data.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Delivery $delivery)
    {
        //
    }

    // approved delivery
    public function approveAccount($id){
        $user = Auth::user();
        $delivery = Delivery::where('id', $id)->first();
        if ($user && $user->role === 'admin') {
            try {
                $delivery->update([
                    'admin_approval' => 'approved'
                ]);
                $deliveries = Delivery::paginate(10);
                return view('dashboard' , ['deliveries' => $deliveries]);
            } catch (\Exception $e) {
                // Log any errors that occur during the update process
                \Log::error('Error updating admin_approval: ' . $e->getMessage());
                return response()->json('Failed to update admin_approval', 500);
            }
        }
        return abort(401, 'Unauthorized');  
    }

    // reject delivery
    public function rejectAccount($id){
        $user = Auth::user();
        $delivery = Delivery::where('id', $id)->first();
        if($user->role == 'admin'){
            $delivery->update([
                'admin_approval' => 'rejected'
            ]);
            // dd($delivery);
            $deliveries = Delivery::paginate(10);
            return view('dashboard' , ['deliveries' => $deliveries]);
        }
        return abort(401, 'Unauthorized');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
        
            $delivery = Delivery::findOrFail($id);
            $delivery->delete();
            
            return back()->with('success', 'Delivery deleted successfully.');
        
    } catch (\Exception $e) {
        return back()->with('error', 'An error occurred while deleting the delivery.');
    }
    }
}
