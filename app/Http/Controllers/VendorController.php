<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Events\VendorRegistered;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    public function index()
    {
        return response()->json(['data' => Vendor::all()]);
    }

    public function getSingleItem($id)
    {
        $existingVendor = Vendor::find($id);
        if($existingVendor) {
            $vendor = Vendor::where('id', $existingVendor->id)->get();
            return response()->json([
                'data' => $vendor
            ], 200);
        }
        return response()->json(['No record found']);

    }

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
