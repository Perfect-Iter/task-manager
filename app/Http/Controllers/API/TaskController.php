<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\User;
use App\Models\UserTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $statuses = UserTask::where('user_id', str_replace('"', "", $request->email))
        ->join('tasks', 'tasks.task_id', '=', 'user_tasks.task_id')
        ->leftJoin('task_statuses', 'task_statuses.status_id', '=', 'tasks.status_id')
        ->get();

        $response = [
            'success' => true,
            'data' => TaskResource::collection($statuses)
        ];

        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'description' => 'required',
            'due_date' => 'required',

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
            $user = User::where('email', $request->email)->first();
            $task = new Task();
            $task->task_name = $request->name;
            $task->description = $request->description;
            $task->due_date =  Carbon::parse($request->due_date)->format('Y-m-d');
            $task->status_id = 1;
            $task->save();

            $recentEntry = Task::latest()->first();

            $user_task = new UserTask();
            $user_task->task_id = $recentEntry->task_id;
            $user_task->user_id = str_replace('"', "", $request->email);
            $user_task->save();

            $res = [
                'success' => true,
                'message' => 'Task Status created successfully'
            ];
            return response()->json($res, 201);

        }catch(\Exception $e){
            $response = [
                'success' => false,
                'message' => 'Failed to create task',
                'errors' => $e
            ];
            return response()->json($response, 409);
        }
    }

    public function start_task(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);

        //handle validation errors
        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400);
        }
        $now = Carbon::now()->toDateTimeString();

        $task = UserTask::where('user_id', $request->email)
        ->where('task_id', $id)
        ->first();

        $task->start_time = $now;
        $task->save();

        //add status change

        $res = [
            'success' => true,
            'message' => 'Task has been started successfully'
        ];
    }

    public function end_task(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'remark' => 'required',
        ]);

        //handle validation errors
        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400);
        }
        $now = Carbon::now()->toDateTimeString();

        $task = UserTask::where('user_id', $request->email)
        ->where('task_id', $id)
        ->first();

        $task->start_time = $now;
        $task->save();

        $res = [
            'success' => true,
            'message' => 'Task has been started successfully'
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
