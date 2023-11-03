<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreclientRequest;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Http\Resources\ClientResource;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //validation or security

        $clients = Client::with('phone')->get();
        $clientsWithPhones = $clients->map(function ($client) {
            $client['phones'] = $client->phone->pluck('phone')->toArray();
            unset($client['phone']);
            return $client;
        });
        
        return response()->json($clientsWithPhones, 200);    
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request)
    {
        $validated = $request->validated();
        $clientPhones = $request->input('phone');
        $client = Client::create($request->all());

        if (is_array($clientPhones)) {
            foreach ($clientPhones as $phone) {
                $client->client_phone()->create(['phone' => $phone]);
            }
        } else {
            $client->client_phone()->create(['phone' => $clientPhones]);
        }

        return (new ClientResource($client))->response()->setStatusCode(200);

    }
    public function createUser(Request $request)
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

            // $user = User::create([
            //     'name' => $request->name,
            //     'email' => $request->email,
            //     'password' => Hash::make($request->password)
            // ]);

            // return response()->json([
            //     'status' => true,
            //     'message' => 'User Created Successfully',
            //     'token' => $user->createToken("API TOKEN")->plainTextToken
            // ], 200);

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
    public function update(ClientRequest $request, Client $client)
    {
        $validated = $request->validated();
        $client->update($request->all());
        return new  ClientResource ($client);
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
