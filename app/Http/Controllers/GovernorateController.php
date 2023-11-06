<?php

namespace App\Http\Controllers;

use App\Models\Governorate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\GovernorateResource;

class GovernorateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $governorates = Governorate::all();
        return response()->json(GovernorateResource::collection($governorates), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'governorates' => 'required|array',
            'governorates.*.name' => 'required',
            'governorates.*.cities' => 'required|array',
            
        ]);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        };
        $governorates = $request->input('governorates');
        
        foreach ($governorates as $governorate) {
            $governorateName = $governorate['name'];
            $cities = $governorate['cities'];
            $newGov = Governorate::create([
                'governorate' => $governorateName
            ]);
            foreach($cities as $city) {
                $newGov->cities()->create([
                    "city" => $city
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Governorate $governorate)
    {
        return new GovernorateResource($governorate);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Governorate $governorate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Governorate $governorate)
    {
        //
    }
}
