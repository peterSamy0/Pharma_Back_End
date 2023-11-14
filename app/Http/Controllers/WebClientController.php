<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Resources\ClientResource;

class WebClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = Client::all();
        // @dump( $client);
       $client = ClientResource::collection($client , 200 );
       return view('dashboard' , ['clients' => $client]);
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $client= Client::findOrFail($id);
            return view('Client.show', ['client' => $client ]);
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while retrieving the data.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
        
            $client = Client::findOrFail($id);
            $client->delete();
            
            return back()->with('success', 'Client deleted successfully.');
        
    } catch (\Exception $e) {
        return back()->with('error', 'An error occurred while deleting the client.');
    }
    }
}
