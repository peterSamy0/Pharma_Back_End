<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreclientRequest;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Http\Resources\ClientResource;
use App\Http\Requests\ClientRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //validation or security

        $clients = Client::all();

        // $clients = Client::with('phone')->get();
        // $clientsWithPhones = $clients->map(function ($client) {
        //     $client['phones'] = $client->phone->pluck('phone')->toArray();
        //     unset($client['phone']);
        //     return $client;
        // });
        
        return response()->json($clients, 200);    
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // try{
            $userData = $request->input('user');
            $clientData = $request->input('client');
            $user = User::create($userData);
            $clientData['user_id'] = $user->id;
            $client = Client::create($clientData);
    
            return (new ClientResource($client))->response()->setStatusCode(200);
        // }catch(Exception $e){
        //     Log::error($e->getMessage());
        //     return response()->json(['error' => Log::error($e->getMessage())], 500);       
        //  }
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
        return new  ClientResource ($client,200);
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
