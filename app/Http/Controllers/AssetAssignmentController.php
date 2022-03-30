<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Events\AssetAssignmentRegistered;
use App\Models\AssetAssignment;

class AssetAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assetAssignment = AssetAssignment::all();

        return response()->json([
            'data' => $assetAssignment
        ]);
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
            'asset_id' => 'required',
            'assignmentDate' => 'required',
            'status' => 'required',
            'isDue' => 'required',
            'dueDate' => 'required',
            'assignmentUserId' => 'required',
            'assignedBy' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                $validator->errors()
            ]);
        }


        $assetAssignment = AssetAssignment::create([
            'asset_id' => $request->asset_id,
            'assignmentDate' => $request->assignmentDate,
            'status' => $request->status,
            'isDue' => $request->isDue,
            'dueDate' => $request->dueDate,
            'assignmentUserId' => $request->assignmentUserId,
            'assignedBy' => $request->assignedBy
        ]);

        // Block of cord is calling and dispatching an event.
        AssetAssignmentRegistered::dispatch($assetAssignment);

        if($assetAssignment) {
            return response()->json([
                "Message" => "Data saved successfully",
                'data' => $assetAssignment
            ]);
        }else{
            return response()->json([
                "Message" => "Something went wrong please try again."
            ]);
        }
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
        $assetAssignment = AssetAssignment::find($id);

        if($assetAssignment) {
            $assetAssignment->asset_id = $request->asset_id;
            $assetAssignment->assignmentDate = $request->assignmentDate;
            $assetAssignment->status = $request->status;
            $assetAssignment->isDue = $request->isDue;
            $assetAssignment->dueDate = $request->dueDate;
            $assetAssignment->assignmentUserId = $request->assignmentUserId;
            $assetAssignment->assignedBy = $request->assignedBy;

            $assetAssignment->save();

            return response()->json([
                'Message' => 'Data updated successfully',
                'data' => $assetAssignment
            ]);
        }
        return response()->json([
            'Message' => 'No record found'
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
        $assetAssignment = AssetAssignment::find($id);

        if($assetAssignment){
            $assetAssignment->delete();
            return response()->json([
                'Message' => 'data deleted successfully'
            ]);
        }
        return response()->json([
            'Message' => 'No record found'
        ]);
    }
}
