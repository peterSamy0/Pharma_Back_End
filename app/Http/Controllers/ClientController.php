<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreclientRequest;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Http\Resources\ClientResource;
use App\Http\Requests\ClientRequest;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Hash;
use Log;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */

        // $clients = Client::with('phone')->get();
        // $clientsWithPhones = $clients->map(function ($client) {
        //     $client['phones'] = $client->phone->pluck('phone')->toArray();
        //     unset($client['phone']);
        //     return $client;
        // });
        public function index()
        {
            $clients = Client::all();
        
            return response()->json( ClientResource::collection($clients), 200);
        } 

    /**
     * Store a newly created resource in storage.
     */

    //     $clientPhones = $request->input('phone');
    //     if (is_array($clientPhones)) {
    //         foreach ($clientPhones as $phone) {
    //             $client->clientPhone()->create(['phone' => $phone]);
    //         }
    //     } else {
    //         $client->client_phone()->create(['phone' => $clientPhones]);
    //     }

    public function store(Request $request)
    {
        try {
            //Validated
            // $validateUser = Validator::make($request->all(), 
            // [
            //     'user.name' => 'required',
            //     'user.email' => 'required|email|unique:users,email',
            //     'user.password' => 'required',
            //     'client.governorate_id' => 'required',
            //     'client.city_id' => 'required'
            // ]);

            // if($validateUser->fails()){
            //     return response()->json([
            //         'status' => false,
            //         'message' => 'validation error',
            //         'errors' => $validateUser->errors()
            //     ], 401);
            // }

            $user = User::create([
                'name' => $request->user['name'],
                'email' => $request->user['email'],
                'password' => Hash::make($request->user['password'])
            ]);

            $client = Client::create([
                'user_id' => $user->id,
                'governorate_id' => $request->client['governorate_id'],
                'city_id' => $request->client['city_id'],
                'role' => 'client'
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'user_id' => $user->id,
                'client_id' => $client->id,
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
        if($client->id){
            return  new ClientResource($client);
        }
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        try{
            $user = User::find($client->user_id);
            $user->name = $request->user['name'];
            $user->email = $request->user['email'];
            $user->password = Hash::make($request->user['password']);
            $user->update();
            
            $client->governorate_id = $request->client['governorate_id'];
            $client->city_id = $request->client['city_id'];
            $client->update();

            return response()->json($user,200);

        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);       
         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        // validation , security
        if($client->id){
            $client->delete();
            return "client deleted";
        }
        return abort(404);
    }
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