<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        // dd($request);
        //validation, security
        $validator = Validator::make($request->all(),[
            'pharmacy_id' => 'required | numeric',
            'delivery_id'=> 'nullable | numeric',
            'ordMedications' => 'required|array',
            'ordMedications.*.key' => 'required|numeric',
            'ordMedications.*.value' => 'required|numeric',
            
        ]);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        };
       
        $savedOrder = Order::create([
            'pharmacy_id' => $request->pharmacy_id,
            'client_id' => $request->client_id //auth()->id(); when making authentication
        ]);
        // insert ordered medications
        // data will come from frontend in an assoc. array, 'medication_id' => amount
        $ordMedications = $request->input('ordMedications');
        
        foreach ($ordMedications as $ordMedication) {
            $medicineId = $ordMedication['key'];
            $amount = $ordMedication['value'];
            $savedOrder->orderMedications()->create([
                'medicine_id' => $medicineId,
                'amount' => $amount,
            ]);
        }
        return response()->json($savedOrder, 200);
        
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
{
    // Eager load the 'orderMedications' relationship along with the 'medication' relationship for each 'OrderMedication'
    $order = Order::with('orderMedications.medication')->find($order->id);

    if ($order) {
        return new OrderResource($order);
    }

    return abort(404);
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        if($order->status == "pending"){
            $orderForm = $request->validate([
                'ordMedications.*.key' => 'required',
                'ordMedications.*.value' => 'required',
                
            ]);
            $ordMedications = $request->input('ordMedications');
            foreach($ordMedications as $medicineId => $amount){
                $order->orderMedications()->update([
                    'medicine_id' => $medicineId,
                    'amount' => $amount,
                ]);
            }
            return response()->json([$order,$order->orderMedications ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        if($order){
            $order->delete();
            $order->orderMedications()->delete();
            return response()->json(["order deleted successfully"], 200);
        }else{
            return response()->json(["order not found"], 404);
        }
    }
}
