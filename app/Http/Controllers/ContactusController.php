<?php

namespace App\Http\Controllers;

use App\Models\Contactus;
use Illuminate\Http\Request;

class ContactusController extends Controller
{
    public function index()
    {
        return Contactus::all();
    }

    public function create()
    {
        // You can add logic to show a form for creating new contact entries.
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $contactus = Contactus::create($request->all());

        return response()->json([
            'message' => 'Your contact information has been submitted successfully.',
            'contactus' => $contactus,
        ]);
    }

    public function show(Contactus $contactus)
    {
        return response()->json([
            'contactus' => $contactus,
        ]);
    }

    public function edit(Contactus $contactus)
    {
        // You can add logic to show a form for editing a specific contact entry.
    }

    public function update(Request $request, Contactus $contactus)
    {
        // You can add logic to update a specific contact entry.
    }

    public function destroy(Contactus $contactus)
    {
        $contactus->delete();

        return response()->json([
            'message' => 'The contact entry has been deleted successfully.',
        ]);
    }
}
