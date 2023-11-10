<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
	dd(Auth::user());
        $orders = Order::all();
        $returnOrders = [];
        foreach($orders as $order){
            array_push($returnOrders,new OrderResource($order));
        }
        // dd($returnOrders);
        return response()->json($returnOrders, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(orderRequest $request)
    {
       
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
        // if(!$order || $order->client_id !== auth()->user()->id){
        //     return abort(404);
        // }
        if($order->status == "pending"){
            $validator = Validator::make($request->all(),[
                'ordMedications' => 'required|array',
                'ordMedications.*.key' => 'required|numeric',
                'ordMedications.*.value' => 'required|numeric',
                
            ]);
            if($validator->fails()){
                return response()->json(['errors' => $validator->errors()], 422);
            };
            $ordMedications = $request->input('ordMedications');
            try{
                foreach ($ordMedications as $ordMedication) {
                    $medicineId = $ordMedication['key'];
                    $amount = $ordMedication['value'];
                    $order->orderMedications()->update([
                        'medicine_id' => $medicineId,
                        'amount' => $amount,
                    ]);
                
                }
            }catch(Exception $e){
                return response()->json($e,500);
            }
            // return response()->json([$order,$order->orderMedications ], 200);
            return $this->show($order);
        }else{
            return response()->json("sorry, the order has been prepared by the pharmacy",200);
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
