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
    public function store(PharmacyRequest $request)
    {
        try {
            //Validated
            $validator = $request->validated();
           
            //validations error messages 
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
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
    public function update( Request $request, Pharmacy $pharmacy)
    {  
        try{

            $user = User::find($pharmacy->user_id);
            $user->name = $request->user['name'];
            $user->email = $request->user['email'];
            $user->password = Hash::make($request->user['password']);
            $user->update();
            $pharmacy->image = $request->pharmacy['image'];
            $pharmacy->licence_number = $request->pharmacy['licence_number'];
            $pharmacy->bank_account = $request->pharmacy['bank_account'];
            $pharmacy->governorate_id = $request->pharmacy['governorate_id'];
            $pharmacy->city_id = $request->pharmacy['city_id'];
            $pharmacy->street = $request->pharmacy['street'];
            $pharmacy->opening = $request->pharmacy['opening'];
            $pharmacy->closing = $request->pharmacy['closing'];
            $pharmacy->user_id = $user->id;
            $pharmacy->update();
    
            $daysOff = $request->input('daysOff');
            if ($daysOff) {
                foreach ($daysOff as $dayOff) {
                    PharmacyDayOff::where('pharmacy_id', $pharmacy->id)
                        ->update([
                            'day_id' =>  $dayOff, // Specify the column name and the new value to update
                        ]);
                }
            }
            return response()->json($user, 200);
        } catch(\Throwable $th){
            return response()->json($th->getMessage(), 403);
        }
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













// example for insert data for pharmacy 
// {
//     "user": {
//         "name" : "test" ,
//         "email" : "tes1t@gmail.com" ,
//         "password" :  "123456789"
//     },
//     "pharmacy" : {  
//         "image" : "test.png",
//         "licence_number" : 147856932,
//         "bank_account" : 2589634,
//         "governorate_id" : 20,
//         "city_id" : 1,
//         "street" : "street test",
//         "opening" : "12:00:00",
//         "closing" : "06:00:00"
//     },
//     "daysOff": [1, 2]
