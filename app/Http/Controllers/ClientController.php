<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //validation or security
        $clients = Client::with('phone')->get();
        return response()->json($clients, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validation, security
        $clientData = $request->only([
            'name',
            'Governorate',
            'city',
            'email',
            'password',
        ]);

        $clientPhones = $request->input('phone');
        $client = Client::create($clientData);

        foreach ($clientPhones as $phone) {
            $client->phone()->create([
                'phone' => $phone
            ]);
        }
        return response()->json($client,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        if($client->id){
            return response()->json($client, 200);
        }
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $client->update($request->all());
        return response()->json($client,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        // validation , security
        if($client->id){
            $client->delete();
            return response()->json("client deleted",200);
        }
        return abort(404);
    }
}
