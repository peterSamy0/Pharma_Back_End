<?php

namespace App\Http\Controllers;

use App\Models\Medication;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\MedicationResource;
use App\Http\Requests\MedicationRequest;

class WebMedicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medications = Medication::paginate(10);
        // @dump( $medications);
       $medications = MedicationResource::collection($medications , 200 );
       return view('dashboard' , ['medications' => $medications]);
       
    }
        // 

        public function create()
        {
            $category=Category::all();
            // @dump($category);
            return view('Medication.create' , ['data' => $category]);
        }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        request()->validate([
            "name" => "required | unique:medications",
            "price" => "required | integer",
            "image" => "required",
            "description" => "required",
            'category_id' => "required",
        ]);

        $data = $request->all();
        if($request->hasFile('image')){
            $trackImage= $data["image"];
            $path=$trackImage->store("uploadedIMages" , "Store_Images");
            $data["image"]=$path;
        }
        Medication::create($data);
        return to_route('medications.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $medication = Medication::findOrFail($id);
            return view('Medication.show', ['medication' => $medication ]);
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while retrieving the data.');
        }
    }
    // /

    public function edit($id)
    {
        try {
            $medication = Medication::find($id);
            if ($medication) {
                return view('Medication.edit', ['medication' => $medication]);
            } else {
                return abort(403, 'You are not allowed to edit this medication.');
            }
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while retrieving the data.');
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request , $id)

    {           
        try {
            $medication = Medication::findOrFail($id);
        
            $medication->update([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
            ]);
        
            return back()->with('success', 'Medication updated successfully.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return back()->with('error', 'Medication not found.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while updating the medication.');
        }
        
        
    }
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
        
                $medication = Medication::findOrFail($id);
                $medication->delete();
                
                return back()->with('success', 'Medication deleted successfully.');
            
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while deleting the medication.');
        }
    }
}
