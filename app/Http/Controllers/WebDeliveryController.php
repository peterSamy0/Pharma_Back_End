<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;
use App\Http\Resources\DeliveryResource;

class WebDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $delivery = Delivery::all();
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
