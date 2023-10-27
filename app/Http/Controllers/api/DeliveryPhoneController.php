<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Delivery_phone;
use Illuminate\Http\Request;
use App\Http\Resources\DeliveryPhoneResource;
class DeliveryPhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $del_phone = Delivery_phone::all();
        return DeliveryPhoneResource::collection($del_phone);
    }

    public function store(Request $request)
    {
        //
        $del_phone = Delivery_Phone::create($request->all());
        return $del_phone;
    }

    /**
     * Display the specified resource.
     */
    public function show(Delivery_phone $delivery_phone)
    {
        //
        
    }

   
    public function update(Request $request, Delivery_phone $delivery_phone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Delivery_phone $delivery_phone)
    {
        //
    }
}
