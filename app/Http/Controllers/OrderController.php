<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // middlware to view only pharmacy's orders
        // ......
        $orders = Order::all();
        return response()->json($orders, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validation, security
        $orderForm = $request->validate([
            'pharmacy_id' => 'required',
            'delivery_id'=> 'nullable',
            'ordMedications.*.key' => 'required',
            'ordMedications.*.value' => 'required',
            
        ]);
        $newOrder = new Order();
        $newOrder->client_id = auth()->id();
        $newOrder->pharmacy_id = $orderForm['pharmacy_id'];
        $savedOrder = Order::create($newOrder);
        // insert ordered medications
        // data will come from frontend in an assoc. array, 'medication_id' => amount
        $ordMedications = $request->input('ordMedications');
        foreach($ordMedications as $medicineId => $amount){
            $savedOrder->orderMedications()->create([
                'medicine_id' => $medicineId,
                'amount' => $amount,
            ]);
        }
        return response()->json([$savedOrder,$savedOrder->orderMedications ], 200);
        
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
