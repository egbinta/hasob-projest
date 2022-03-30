<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Events\VendorRegistered;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendor = Vendor::all();

        return response()->json(['data' => $vendor]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator()->make(request()->all(), [
            'name' => 'required',
            'category' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                $validator->errors()
            ]);
        }

        $vendor = Vendor::create([
            'name' => $request->name,
            'category' => $request->category,
        ]);

        // Block of cord is calling and dispatching an event.
        VendorRegistered::dispatch($vendor);

        if($vendor) {
            return response()->json([
                "Message" => "Vendor created successfully",
                "data" => $vendor
            ]);
        }
        return response()->json([
            "Message" => "Something went wrong try again"
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $existingVendor = Vendor::find($id);

        if($existingVendor) {
            $existingVendor->name = $request->name;
            $existingVendor->category = $request->category;

            $existingVendor->save();

            return response()->json([
                "Message" => "Vendor updated",
                "data" => $existingVendor
            ]);
        }

        return response()->json([
            "Message" => "No record found"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingVendor = Vendor::find($id);

        if($existingVendor) {
            $existingVendor->delete();
            return response()->json([
                "Message" => "Vendor deleted successfully"
            ]);
        }

        return response()->json([
            "message" => "No record found"
        ]);
    }
}
