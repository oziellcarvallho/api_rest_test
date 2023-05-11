<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class ApiTaskController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission.api:task-view',          ['only' => ['index', 'show']]);
        $this->middleware('permission.api:task-create',        ['only' => ['store']]);
        $this->middleware('permission.api:task-edit',          ['only' => ['update']]);
        $this->middleware('permission.api:task-delete',        ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::paginate(15);
        return response()->json(['tasks' => $tasks]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        $fields = $request->only([
            'title', 'description', 'deadline', 'executor_id', 'project_id'
        ]);

        $task = Task::create($fields);

        return response()->json([
            'message' => 'Task successfully created',
            'task' => $task
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return response()->json(['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $fields = $request->only([
            'title', 'description', 'deadline', 'executor_id', 'project_id'
        ]);

        $task->update($fields);

        return response()->json([
            'message' => 'Task successfully updated',
            'task' => $task
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json([
            'message' => 'Task successfully deleted',
            'task' => $task
        ]);
    }
}
