<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientOrdersRescource;
use Log;
use Exception;
use App\Models\User;
use App\Models\Client;
use App\Models\UserPhone;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\ClientResource;
use App\Http\Requests\StoreclientRequest;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */

        function __construct(){
            $this->middleware('auth:sanctum')->only(['show', 'destroy', 'update']);
        }

        public function index()
        {
            $clients = Client::all();
            return response()->json( ClientResource::collection($clients), 200);
        } 

    /**
     * Store a newly created resource in storage.
    */

    public function store(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make($request->all(), 
            [
                'userFullName' => 'required',
                'userEmail' => 'required|email|unique:users,email',
                'userPass' => 'required',
                'userImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'userGovern' => 'required',
                'userCity' => 'required',
                'userPhone' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if ($request->hasFile('userImage')) {
                $imagePath = $request->file('userImage')->store('images/profile', 'public');
            } else {
                $imagePath = null;
            }
        
            $user = User::create([
                'name' => $request->userFullName,
                'email' => $request->userEmail,
                'password' => Hash::make($request->userPass),
                'image' =>  $imagePath
            ]);

            $client = Client::create([
                'user_id' => $user->id,
                'governorate_id' => $request->userGovern,
                'city_id' => $request->userCity,
                'role' => 'client'
            ]);

            $userPhones = $request->input('userPhone');
            UserPhone::create([
                'user_id' => $user->id,
                'phone' => $userPhones
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'user_id' => $user->id,
                '_id' => $client->id,
                'image' => $user->image,
                'role' => ($user->role) ? $user->role : 'client',
                'token' => $user->createToken("API TOKEN")->plainTextToken,
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
    public function show(Client $client)
    {
        $user = Auth::user();
        if($user->id == $client->user_id){
            if($client->id){
                return  new ClientResource($client);
            }
        }
        return abort(403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $user = Auth::user();
        if($user->id == $client->user_id || $user->role == "admin")
            try{
                $user = User::find($client->user_id);
                $user->name = $request->user['name'];
                $user->email = $request->user['email'];
                $user->password = Hash::make($request->user['password']);
                $user->update();
                
                $client->governorate_id = $request->client['governorate_id'];
                $client->city_id = $request->client['city_id'];
                $client->update();
    
                $phone = $request->user['phone'];
                $userPhone = UserPhone::where('user_id', $user->id)->first();
                $userPhone->update([
                    'phone' => $phone
                ]);
                return response()->json($user,200);
    
            }catch(\Throwable $th){
                return response()->json(['error' => $th->getMessage()], 500);       
            }
        }
        return abort(403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        // validation , security
        $user = Auth::user();
        if($user->id == $client->user_id || $user->role == "admin"){
            if($client->id){
                $client->delete();
                return "client deleted";
            }
        }
        return abort(403);
    }






// example for update and inserting data in clients
// {
//     "user": {
//         "name" : "second update" ,
//         "email" : "littel.domenick@example.org",
//         "password" :  "123456789"
//     },
//     "client" : {  
//         "governorate_id" : 20,
//         "city_id" : 45
//     }
// }



// view client 
// {
//     "data": {
//         "user_id": 1,
//         "client_name": "Anabel Bechtelar",
//         "client_email": "schiller.aaliyah@example.org",
//         "Governorate": "District of Columbia",
//         "city": "Bauchfort",
//         "orders": [
//             {
//                 "id": 5,
//                 "client name": "Anabel Bechtelar",
//                 "pharmacy name": "Miss Stacey Tillman III",
//                 "delivery name": "Dennis Wisoky",
//                 "status": "pending",
//                 "created at": "2023-11-05T20:10:13.000000Z",
//                 "updated at": "2023-11-05T20:10:13.000000Z",
//                 "orderMedications": [
//                     {
//                         "medicine id": 75,
//                         "amount": 1,
//                         "created_at": "2023-11-05T20:10:20.000000Z",
//                         "updated_at": "2023-11-05T20:10:20.000000Z"
//                     },
//                     {
//                         "medicine id": 19,
//                         "amount": 1,
//                         "created_at": "2023-11-05T20:10:21.000000Z",
//                         "updated_at": "2023-11-05T20:10:21.000000Z"
//                     },
//                     {
//                         "medicine id": 16,
//                         "amount": 9,
//                         "created_at": "2023-11-05T20:10:22.000000Z",
//                         "updated_at": "2023-11-05T20:10:22.000000Z"
//                     }
//                 ]
//             },
//             {
//                 "id": 19,
//                 "client name": "Anabel Bechtelar",
//                 "pharmacy name": "Dr. Michelle Huel Jr.",
//                 "delivery name": "Rubye Schimmel",
//                 "status": "accepted",
//                 "created at": "2023-11-05T20:10:13.000000Z",
//                 "updated at": "2023-11-05T20:10:13.000000Z",
//                 "orderMedications": [
//                     {
//                         "medicine id": 31,
//                         "amount": 2,
//                         "created_at": "2023-11-05T20:10:23.000000Z",
//                         "updated_at": "2023-11-05T20:10:23.000000Z"
//                     },
//                     {
//                         "medicine id": 89,
//                         "amount": 4,
//                         "created_at": "2023-11-05T20:10:24.000000Z",
//                         "updated_at": "2023-11-05T20:10:24.000000Z"
//                     },
//                     {
//                         "medicine id": 69,
//                         "amount": 3,
//                         "created_at": "2023-11-05T20:10:26.000000Z",
//                         "updated_at": "2023-11-05T20:10:26.000000Z"
//                     }
//                 ]
//             }
//         ]
//     }
// }