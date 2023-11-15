<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pharmacy;
use App\Models\UserPhone;
use Illuminate\Http\Request;
use App\Models\PharmacyDayOff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PharmacyRequest;
use App\Http\Resources\PharmacyResourse;
use Illuminate\Support\Facades\Validator;

class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    function __construct(){
        $this->middleware('auth:sanctum')->only([ 'destroy', 'update']);
    }

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
        try {
            //Validated
            // $validateUser = Validator::make($request->all(), 
            // [
            //     'pharmaName' => 'required',
            //     'pharmaEmail' => 'required|email|unique:users,email',
            //     'pharmaPass' => 'required',
            //     'pharmaGovern' => 'required',
            //     'pharmaCity' => 'required',
            //     'pharmaStreet' => 'required',
            //     'pharmaLicense' => 'required',
            //     'pharmaOpeningTime' => 'required',
            //     'pharmaClosingTime' => 'required',
            //     'pharmaBankAccount' => 'required',
            //     'userImage' => 'required',
            //     'pharmaPhone' => 'required',
            // ]);

            // if($validateUser->fails()){
            //     return response()->json([
            //         'status' => false,
            //         'message' => 'validation error',
            //         'errors' => $validateUser->errors()
            //     ], 401);
            // }

            if ($request->hasFile('userImage')) {
                $imagePath = $request->file('userImage')->store('images/profile', 'public');
            } else {
                $imagePath = null;
            }
            $user = User::create([
                'name' => $request->pharmaName,
                'email' => $request->pharmaEmail,
                'password' => Hash::make($request->pharmaPass),
                'image' => $imagePath,
                'role' => 'pharmacy'
            ]);
            
            $pharmacy = Pharmacy::create([
                'licence_number' => $request->pharmaLicense,
                'bank_account' => $request->pharmaBankAccount,
                'governorate_id' => $request->pharmaGovern,
                'city_id' => $request->pharmaCity,
                'street' => $request->pharmaStreet,
                'opening' => $request->pharmaOpeningTime,
                'closing' => $request->pharmaClosingTime,
                'user_id' => $user->id,
            ]);            	
            
            $daysOff = $request->input('pharmacyDayOff');
            if(is_array($daysOff)){
                foreach($daysOff as $dayOff){
                    PharmacyDayOff::create([
                        'day_id' => $dayOff,
                        "pharmacy_id" => $pharmacy->id
                    ]);
                };
            }

            $userPhones = $request->input('pharmaPhone');
            UserPhone::create([
                'user_id' => $user->id,
                'phone' => $userPhones
            ]);
            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'user_id' => $user->id,
                'role' => $user->role,
                'image' => $user->image,
                'pharmacy_id' => $pharmacy->id,
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
        // $user = Auth::user();
        // if($user->id == $pharmacy->user_id){
            return new PharmacyResourse($pharmacy);  
        // }
        // return abort(403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( Request $request, Pharmacy $pharmacy)
    {  
        $user = Auth::user();
        if($user->id == $pharmacy->user_id){
            try{
                $user = User::find($pharmacy->user_id);
                $user->name = $request->user['name'];
                $user->email = $request->user['email'];
                $user->password = Hash::make($request->user['password']);
                $user->save();
                $pharmacy->licence_number = $request->pharmacy['licence_number'];
                $pharmacy->bank_account = $request->pharmacy['bank_account'];
                $pharmacy->governorate_id = $request->pharmacy['governorate_id'];
                $pharmacy->city_id = $request->pharmacy['city_id'];
                $pharmacy->street = $request->pharmacy['street'];
                $pharmacy->opening = $request->pharmacy['opening'];
                $pharmacy->closing = $request->pharmacy['closing'];
                $pharmacy->user_id = $user->id;
                $pharmacy->save();
        
                $daysOff = $request->input('daysOff');
                if ($daysOff) {
                    foreach ($daysOff as $dayOff) {
                        PharmacyDayOff::where('pharmacy_id', $pharmacy->id)
                            ->update([
                                'day_id' =>  $dayOff, // Specify the column name and the new value to update
                            ]);
                    }
                }
                $phone = $request->user['phone'];
                $userPhone = UserPhone::where('user_id', $user->id)->first();
                $userPhone->update([
                    'phone' => $phone
                ]);

                return response()->json($user, 200);
            } catch(\Throwable $th){
                return response()->json($th->getMessage(), 403);
            }
        }
        return abort(403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pharmacy $pharmacy)
    {
        $user = Auth::user();
        if($user->id == $pharmacy->user_id){
            $pharmacy->delete();
            return " Delete the pharmacy is Done";
        }
        return abort(403);
    }

    public function getPharmacyOrders(Pharmacy $pharmacy)
    {
        $user = Auth::user();
        if($user->id == $pharmacy->user_id){
            
            return " Delete the pharmacy is Done";
        }
        return abort(403);
    }

}



/**  */
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
