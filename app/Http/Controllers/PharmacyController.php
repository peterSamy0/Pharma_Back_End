<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use App\Models\PharmacyDayOff;
use Illuminate\Http\Request;
use App\Http\Resources\PharmacyResourse;
use App\Http\Requests\PharmacyRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        try{
            $pharmacy = Pharmacy::all();
            return PharmacyResourse::collection($pharmacy);
           
        }catch(\Throwable $th){
            return response()->json([
                'status'=> false,
                "message" => $th->getMessage()
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validated = $request->validated();
        // $pharmacy= Pharmacy::create($request->all());
        // return  new PharmacyResourse($pharmacy);
        try {
            //Validated
            $validateUser = Validator::make($request->all(), 
            [
                'user.name' => 'required',
                'user.email' => 'required|email|unique:users,email',
                'user.password' => 'required',
                'pharmacy.governorate_id' => 'required',
                'pharmacy.city_id' => 'required',
                'pharmacy.street' => 'required',
                'pharmacy.licence_number' => 'required',
                'pharmacy.opening' => 'required',
                'pharmacy.closing' => 'required',
                'pharmacy.bank_account' => 'required',
                'pharmacy.image' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'name' => $request->user['name'],
                'email' => $request->user['email'],
                'password' => Hash::make($request->user['password']),
                'role' => 'pharmacy'
            ]);
            $pharmacy = Pharmacy::create([
                'image' => $request->pharmacy['image'],
                'licence_number' => $request->pharmacy['licence_number'],
                'bank_account' => $request->pharmacy['bank_account'],
                'governorate_id' => $request->pharmacy['governorate_id'],
                'city_id' => $request->pharmacy['city_id'],
                'street' => $request->pharmacy['street'],
                'opening' => $request->pharmacy['opening'],
                'closing' => $request->pharmacy['closing'],
                'user_id' => $user->id,
            ]);            	
            
            $daysOff = $request->input('daysOff');
            if($daysOff){
                foreach($daysOff as $dayOff){
                    PharmacyDayOff::create([
                        'day_id' => $dayOff,
                        "pharmacy_id" => $pharmacy->id
                    ]);
                };
            }else{
                PharmacyDayOff::create([
                        'day_id' => null,
                        "pharmacy_id" => $pharmacy->id
                    ]);
            };
            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'user_id' => $user->id,
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Pharmacy $pharmacy){   
        return new PharmacyResourse($pharmacy);  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( PharmacyRequest $request, Pharmacy $pharmacy)
    {   
        $validated = $request->validated();
        $pharmacy->update($request->all());
        return new PharmacyResourse ($pharmacy);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pharmacy $pharmacy)
    {
        $pharmacy->delete();
        return " Delete the pharmacy is Done";
    }
}
