<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Resources\DeliveryResource;


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

    
    public function store(Request $request)
    {
        //

        $validator = Validator::make($request->all(),[
            'name'=>"required",
            "Governorate"=>"required",
            "city"=>"required",
            "email"=>"unique:deliveries",
            "password"=>"required",
            "national_ID"=>"unique:deliveries|integer",
            "available"=>"required|integer|in:1,0"
        ]);
        if($validator->fails()){
            return response($validator->errors(), 422);
        }
        $delivery = Delivery::create($request->all());
        return (new DeliveryResource($delivery))->response()->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Delivery $delivery)
    {
        //        return (new DeliveryResource($delivery))->response()->setStatusCode(200);

        return (new DeliveryResource($delivery))->response()->setStatusCode(200);
    }

  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Delivery $delivery)
    {
        //
        $validator = Validator::make($request->all(),[
            'name'=>"required",
            "Governorate"=>"required",
            "city"=>"required",
            'email' => [
                'required',
                Rule::unique('deliveries')->ignore($delivery->email, 'email'),
            ],
            "password"=>"required",
            "national_ID" => [
                'required',
                Rule::unique('deliveries')->ignore($delivery->national_ID, 'national_ID'),
                'integer',
                'min:14',
            ],
            "available"=>"required|integer|in:1,0"
        ]);
        if($validator->fails()){
            return response($validator->errors(), 422);
        }
        $delivery->update($request->all());

        return (new DeliveryResource($delivery))->response()->setStatusCode(200);

        // return $delivery;

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
