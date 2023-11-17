<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Order;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\OrderResource;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    function __construct(){
        $this->middleware('auth:sanctum')->only(['store','show', 'destroy', 'update']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $orders = Order::all();
        if (Gate::allows('is_pharmacy', $user)) {
            // dd($user->pharmacy->orders);
            $orders = $user->pharmacy->orders;
        } elseif (Gate::allows('is_client', $user)) {
            $orders = $user->client->orders;
        } elseif (Gate::allows('is_delivery', $user)) {
            $orders = $user->delivery->orders;
        } else {
            return response()->json($orders, 200);
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
            'client_id' => $request->client_id,
            'delivery_id' => null,
            'totalprice' => $request->totalPrice,
        ]);
        // Insert ordered medications
        $ordMedications = $request->input('ordMedications');
    
        foreach ($ordMedications as $ordMedication) {
            $medicineId = $ordMedication['key'];
            $amount = $ordMedication['value'];
            $savedOrder->orderMedications()->create([
                'medicine_id' => $medicineId,
                'amount' => $amount,
            ]);
        }
    // return view ("stripe", ["data"=> $savedOrder]);
    // Return the order along with the order ID
    return response()->json(['order' => new OrderResource($savedOrder), 'orderid' => $savedOrder->id], 200);
}
    

    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {
    //     $order = Order::where('pharmacy_id', $id)->first();
    //     if ($order) {
    //         return new OrderResource($order);
    //     }
    //     return abort(404);
    // }
    public function show(Request $request, Order $order)
    {
        // $order = Order::where('pharmacy_id', $id)->first();
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
        $user = Auth::user();
        // return response()->json([$request->delivered],200);
        // if(!$order || $order->client_id !== auth()->user()->id){
        //     return abort(404);
        // }
        
        // if the request is to update delivery
        // dd($request->setDelivery);
        if(Gate::allows('is_delivery', $user)){
            $order->update(
                ["status"=>"withDelivery"]
            );
            return response()->json("order accepted successfully", 200);
        }
        if(Gate::allows('is_client', $user) && $request->delivered){
            // dd($order->delivery->user->name);
            try{
                $order->update([
                    "status" => 'delivered'
                ]);
                return response()->json(['order has been delivered successfully '],200);
            }catch(Exception $e){
                return response()->json([$e->getMessage()],500);

            }

        }
        if(Gate::allows('is_pharmacy', $user)){
            // dd($order->delivery->user->name);
            try{
                $order->update([
                    "delivery_id" => $request->deliveryId
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
                return $this->show($request,$order);
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
