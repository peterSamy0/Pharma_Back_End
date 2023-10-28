<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Http\Resources\ClientResource;
use App\Http\Requests\ClientRequest;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //validation or security
        $clients = Client::all();
        return ClientResource::collection ($clients, 200);
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

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        if($client->id){
            return  new ClientResource($client, 200);
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
