<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;

class WebOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = Order::all();
        // @dump( $order);
       $order = OrderResource::collection($order , 200 );
       return view('dashboard' , ['orders' => $order]);
       
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
            $order = Order::findOrFail($id);
            return view('Order.show', ['order' => $order ]);
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while retrieving the data.');
        }
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
    public function destroy($id)
    {
        try {
        
            $order = Order::findOrFail($id);
            $order->delete();
            
            return back()->with('success', 'Order deleted successfully.');
        
    } catch (\Exception $e) {
        return back()->with('error', 'An error occurred while deleting the order.');
    }
    }
}
