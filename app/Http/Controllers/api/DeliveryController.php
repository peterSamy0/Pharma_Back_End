<?php

namespace App\Http\Controllers\api;

use Exception;
use App\Models\User;
use App\Models\Delivery;
use App\Models\UserPhone;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\DeliveryResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreDeliveryController;
use App\Http\Requests\UpdateDeliveryController;

class DeliveryController extends Controller
{

    function __construct(){
        $this->middleware('auth:sanctum')->only(['show', 'destroy', 'update', 'approveAccount', 'rejectAccount']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if(Auth::user()){
            $userRole = Auth::user()->role; // Assuming the user role is stored in the "role" attribute of the user model.
            if ($userRole == 'admin') {
                $delivery = Delivery::all();
            } else {
                $delivery = Delivery::where('admin_approval', 'approved')->get();
            }
        }else{
            $delivery = Delivery::where('admin_approval', 'approved')->get();
        }
        return DeliveryResource::collection($delivery); 


        // $delivery = Delivery::all();
        // return DeliveryResource::collection($delivery); 
       }

    
       public function store(Request $request)
       {
           try {
               $validator = Validator::make($request->all(), [
                   'name' => 'required',
                   'email' => 'required|email|unique:users,email',
                   'pass' => 'required',
                   'userImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                   'national_ID' => 'required',
                   'governorate' => 'required',
                   'city' => 'required',
                   'phone' => 'required|unique:user_phones,phone',
               ]);
       
               if ($validator->fails()) {
                   return response()->json([
                       'status' => false,
                       'message' => 'Validation error',
                       'errors' => $validator->errors()
                   ], 400);
               }
       
               if ($request->hasFile('userImage')) {
                   $imagePath = $request->file('userImage')->store('images/profile', 'public');
               } else {
                   $imagePath = null;
               }
       
               $user = User::create([
                   'name' => $request->name,
                   'email' => $request->email,
                   'password' => Hash::make($request->pass),
                   'image' => $imagePath,
                   'role' => 'delivery'
               ]);
       
               $delivery = Delivery::create([
                   'national_ID' => $request->national_ID,
                   'governorate_id' => $request->governorate,
                   'city_id' => $request->city,
                   'available' => true,
                   'user_id' => $user->id,
               ]);
       
               $userPhones = $request->input('phone');
               UserPhone::create([
                   'user_id' => $user->id,
                   'phone' => $userPhones
               ]);
       
               return response()->json([
                   'status' => true,
                   'message' => 'User Created Successfully',
                   'user_id' => $user->id,
                   'delivery_id' => $delivery->id,
                   'role' => $user->role,
                   'image' => $user->image,
                   'token' => $user->createToken("API TOKEN")->plainTextToken
               ], 200);
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
        $user = Auth::user();
        if($user){
            if ($user->id == $delivery->user_id && $user->role == "delivery") {
                $deliveryData = Delivery::where('user_id', $user->id)->first();
                if ($deliveryData) {
                    if ($deliveryData->admin_approval == 'approved') {
                        return new DeliveryResource($deliveryData);
                    } elseif ($deliveryData->admin_approval == 'pending') {
                        return response()->json('pending', 200);
                    } else {
                        return response()->json('rejected', 200);
                    }
                } else {
                    return response()->json('delivery not found', 404);
                }
            }
        } else if($user->role == 'client'){
            return new DeliveryResource($deliveryData);
        }
        return abort(403);
    }

  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Delivery $delivery)
    {       
        $user = Auth::user();
        if($user->id == $delivery->user_id){
            try {
                $user = User::find($delivery->user_id);
                $user->name = $request->user['name'];
                $user->email = $request->user['email'];
                $user->password = $request->user['password'];
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
        return abort(403);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Delivery $delivery)
    {
        $user = Auth::user();
        if($user->id == $delivery->user_id){
            $delivery->delete();
            return (new DeliveryResource($delivery))->response()->setStatusCode(201);
        }
        return abort(403);
    }


    public function approveAccount($id){
        $user = Auth::user();
        $delivery = Delivery::where('id', $id)->first();
        if ($user && $user->role == 'admin') {
            $delivery->update([
                'admin_approval' => 'approved'
            ]);

            return response()->json('Approved successfully', 200);
        }
        return abort(401, 'Unauthorized');
    }



    public function rejectAccount($id){
        $user = Auth::user();
        $delivery = Delivery::where('id', $id)->first();
        if($user){
            if($user->role == 'admin'){
                $delivery->update([
                    'admin_approval' => 'rejected'
                ]);
                return response()->json('rejected successfull', 200);
            }
            return abort(401, 'Unauthorized');
        }
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