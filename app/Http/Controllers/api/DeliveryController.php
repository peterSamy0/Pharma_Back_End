<?php

namespace App\Http\Controllers\api;

use Exception;
use App\Models\User;
use App\Models\Delivery;
use App\Models\UserPhone;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\DeliveryResource;
use Illuminate\Support\Facades\Validator;
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

    
    public function store(Request $request)
    {
        try {
            $user = User::create([
                'name' => $request->user['name'],
                'email' => $request->user['email'],
                'password' => Hash::make($request->user['password']),
                'role' => 'delivery'
            ]);
            
            $delivery = Delivery::create([
                // 'image' => $request->delivery['image'],
                'national_ID' => $request->delivery['nationalID'],
                'governorate_id' => $request->delivery['governorateID'],
                'city_id' => $request->delivery['cityID'],
                'available' => $request->delivery['available'],
                'user_id' => $user->id,
            ]);            	
            
            
            if ($delivery) {
                return response()->json([
                    'status' => true,
                    'message' => 'User Created Successfully',
                    'user_id' => $user->id,
                    'delivery_id' => $delivery->id,
                    'role' => $user->role,
                    'token' => $user->createToken("API TOKEN")->plainTextToken
                ], 200);
            } else {
                throw new Exception('Failed to create delivery');
            }

            $userPhones = $request->input('phone');
            if (is_array($userPhones)) {
                foreach ($userPhones as $phone) {
                    UserPhone::create([
                        'user_id' => $user->id,
                        'phone' => $phone
                    ]);
                }
            }

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 400);
        }
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
    public function update(Request $request, Delivery $delivery)
    {       
       
        try {
            $user = User::find($delivery->user_id);
            $user->name = $request->user['name'];
            $user->email = $request->user['email'];
            $user->password = Hash::make($request->user['password']);
            $user->update();
            // $delivery->image = $request->delivery['image'];
            $delivery->national_ID = $request->delivery['nationalID'];
            $delivery->governorate_id = $request->delivery['governorateID'];
            $delivery->city_id = $request->delivery['cityID'];
            $delivery->available = $request->delivery['available'];
            $delivery->user_id = $user->id;
            $delivery->update();

            return response()->json($user, 200);
        } catch(\Throwable $th){
            return response()->json($th->getMessage(), 403);
        }

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


// example for  sign up delivery
// {
//     "user": {
//         "name" : "new delivery" ,
//         "email" : "insert.delivery@example.org",
//         "password" :  "123456789"
//     },
//     "delivery" : { 
//         "nationalID": 12345678945, 
//         "governorateID" : 20,
//         "cityID" : 1,
//         "available": false
//     }
// }

// example for update delivery
// {
//     "user": {
//         "name" : "updated delivery" ,
//         "email" : "updated.delivery@example.org",
//         "password" :  "123456789"
//     },
//     "delivery" : { 
//         "nationalID": 12345678912345, 
//         "governorateID" : 20,
//         "cityID" : 1,
//         "available": true
//     }
// }