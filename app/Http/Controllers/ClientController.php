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
            $validateUser = Validator::make($request->all(), 
            [
                'user.name' => 'required',
                'user.email' => 'required|email|unique:users,email',
                'user.password' => 'required',
                'client.Governorate' => 'required',
                'client.city' => 'required'
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
                'password' => Hash::make($request->user['password'])
            ]);
            $userId = $user->id;
            $client = Client::create([
                'user_id' => $userId,
                'Governorate' => $request->client['Governorate'],
                'city' => $request->client['city'],
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'role' => $user->role,
                'user_id' => $user->role,
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
    public function update(Request $request, Client $client, User $user)
    {
        try{
            $userData = $request->input('user');
            $clientData = $request->input('client');
            $user->update($userData);
            $client->update($clientData);
    
            return (new ClientResource($client))->response()->setStatusCode(200);
        }catch(Exception $e){
            // Log::error($e->getMessage());
            return response()->json(['error' => "internal error"], 500);       
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
