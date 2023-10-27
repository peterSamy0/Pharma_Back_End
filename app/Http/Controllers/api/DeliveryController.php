<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Resources\DeliveryResource;
use App\Http\Requests\StoreDeliveryController;
use App\Http\Requests\UpdateDeliveryController;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $delivery = Delivery::all();
        return DeliveryResource::collection($delivery); 
       }

    
    public function store(StoreDeliveryController $request)
    {
        
        $validator = Validator::make($request->all());
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }


        $del_Phones = $request->input('phone');

        $delivery = Delivery::create($request->all());


        if(is_array( $del_Phones)){
        foreach ($del_Phones as $phone) {
            $delivery->delivery_phone()->create([
                'phone' => $phone
            ]);
        }
        }else{

        $delivery->delivery_phone()->create([
                    'phone' => $del_Phones
        ]);}
        return (new DeliveryResource($delivery))->response()->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Delivery $delivery)
    {

        return (new DeliveryResource($delivery))->response()->setStatusCode(200);
    }

  
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeliveryController $request, Delivery $delivery)
    {
        $validator = Validator::make($request->all());
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
        $delivery->update($request->all());

        return (new DeliveryResource($delivery))->response()->setStatusCode(200);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Delivery $delivery)
    {
        //
        $delivery->delete();
        return (new DeliveryResource($delivery))->response()->setStatusCode(201);
    }
}
