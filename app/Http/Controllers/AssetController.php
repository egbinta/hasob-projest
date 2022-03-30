<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Events\AssetRegistered;
use App\Models\Asset;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asset = Asset::all();
        return response()->json(['data' => $asset]); 
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
            'type' => 'required',
            'serialNumber' => 'required',
            'description' => 'required',
            'fixedOrMovable' => 'required',
            'picturePath' => 'required',
            'purchaseDate' => 'required',
            'startUseDate' => 'required',
            'purchasePrice' => 'required',
            'degradationInYears' => 'required',
            'currentValueInNaira' => 'required',
            'location' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                $validator->errors()
            ]);
        }

        $asset = Asset::create([
            'type' => $request->type,
            'serialNumber' => $request->serialNumber,
            'description' => $request->description,
            'fixedOrMovable' => $request->fixedOrMovable,
            'picturePath' => $request->picturePath,
            'purchaseDate' => $request->purchaseDate,
            'startUseDate'=> $request->startUseDate,
            'purchasePrice' => $request->purchasePrice,
            'warantyExpiryDate' => $request->warantyExpiryDate,
            'degradationInYears' => $request->degradationInYears,
            'currentValueInNaira' => $request->currentValueInNaira,
            'location' => $request->location
        ]);

        // Block of cord is calling and dispatching an event.
        AssetRegistered::dispatch($asset);

        if($asset) {
            return response()->json([
                "Message" => "Asset enterd successfully",
                "data" => $asset
            ]);
        }
        return response()->json([
            "Message" => "Something went wrong please try again."
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
        $asset = Asset::find($id);

        if($asset) {
            $asset->type = $request->type;
            $asset->serialNumber = $request->serialNumber;
            $asset->description = $request->description;
            $asset->fixedOrMovable = $request->fixedOrMovable;
            $asset->picturePath = $request->picturePath;
            $asset->purchaseDate = $request->purchaseDate;
            $asset->startUseDate = $request->startUseDate;
            $asset->purchasePrice = $request->purchasePrice;
            $asset->warantyExpiryDate = $request->warantyExpiryDate;
            $asset->degradationInYears = $request->degradationInYears;
            $asset->currentValueInNaira = $request->currentValueInNaira;
            $asset->location = $request->location;

            $asset->save();

            return response()->json([
                "Message" => "Asset Updated successfully",
                "data" => $asset
            ]);
        }
        return response()->json([
            "Message" => "No record found."
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
        $asset = Asset::find($id);

        if($asset) {
            $asset->delete();
            return response()->json([
                "Message" => "Asset deleted successfully"
            ]);
        }

        return response()->json([
            "Message" => "No record found."
        ]);
    }
}
