<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{

    function __construct(){
        $this->middleware('auth:sanctum')->only(['index','show', 'destroy', 'update']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if (Gate::allows('is_pharmacy', $user)) {
            $orders = $user->pharmacy->orders;
        } elseif (Gate::allows('is_client', $user)) {
            $orders = $user->client->orders;
        } elseif (Gate::allows('is_delivery', $user)) {
            $orders = $user->delivery->orders;
        } else {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
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
    public function store(Request $request)
    {
       
        $savedOrder = Order::create([
            'pharmacy_id' => $request->pharmacy_id,
            'client_id' => $request->client_id, //auth()->id(); when making authentication
            'delivery_id' => null
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
        
        // if the request is to update delivery
        // dd($request->setDelivery);
        if($request->delivery){
            $order->update(
                ["status"=>"withDelivery"]
            );
            return response()->json("order accepted successfully", 200);
        }
        if($request->setDelivery){
            // dd($order->delivery->user->name);
            try{
                $order->update([
                    "delivery_id" => $request->deliveryId,
                    "status" => "withDelivery"
                ]);
                return response()->json(['order has been assigned to ' . $order->delivery->user->name],200);
            }catch(Exception $e){
                return response()->json([$e->getMessage()],500);

            }

        }else{
            // updating order items
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
                        if ($amount === 0) {
                        $order->orderMedications()->where('medicine_id', $medicineId)->delete();
                        if ($order->orderMedications->isEmpty()) {
                            // No associated order medications, so delete the order
                            $order->delete();
                            return response()->json('Order deleted successfully');
                        }
                    } else {
                        // Update the orderMedication
                        $order->orderMedications()->where('medicine_id', $medicineId)->update([
                            'amount' => $amount,
                        ]);
                    }
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
