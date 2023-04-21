<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\StatusResource;
use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $statuses = TaskStatus::all();

        $response = [
            'success' => true,
            'data' => StatusResource::collection($statuses)
        ];

        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:task_statuses',
        ]);

        //handle validation errors
        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400);
        }
        try{
            $status = new TaskStatus();
            $status->name = $request->name;

            $status->save();

            $res = [
                'success' => true,
                'message' => 'Task Status created successfully'
            ];
            return response()->json($res, 201);

        }catch(\Exception $e){
            $response = [
                'success' => false,
                'message' => 'Failed to create status'
            ];
            return response()->json($response, 409);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $status = TaskStatus::where('status_id', $id)->first();

        if($status){
            $response = [
                'success' => true,
                'data' => new StatusResource($status)
            ];

            return response()->json($response, 200);
        } else {
            $response = [
                'success' => false,
                'message' => 'Task Status not found'
            ];

            return response()->json($response, 200);
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:task_statuses',
        ]);

        //handle validation errors
        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400);
        }
        try{

            $status = TaskStatus::where('status_id', $id)->first();
            $status->name = $request->name;

            $status->save();

            $res = [
                'success' => true,
                'message' => 'Task Status created successfully'
            ];
            return response()->json($res, 201);

        }catch(\Exception $e){
            $response = [
                'success' => false,
                'message' => 'Failed to create status'
            ];
            return response()->json($response, 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $status = TaskStatus::where('status_id', $id)->first();
        $status->delete();

        $response = [
            'success' => true,
            'message' => 'Task Status Successfully Deleted'
        ];
        return response()->json($response, 200);
    }
}
