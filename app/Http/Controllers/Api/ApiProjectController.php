<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiProjectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission.api:project-view',          ['only' => ['index', 'show']]);
        $this->middleware('permission.api:project-create',        ['only' => ['store']]);
        $this->middleware('permission.api:project-edit',          ['only' => ['update']]);
        $this->middleware('permission.api:project-delete',        ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $projects = Project::when($request->has('q'), function($query) use ($request){
                $query->where(function ($builder) use ($request) {
                    $builder->where('name', 'like', '%' . $request->q . '%');
                });
            })->orderBy('id', 'desc')->paginate(15);
        
        return response()->json(['projects' => $projects]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $fields = $request->only([
            'name', 'deadline'
        ]);

        $fields['user_id'] = Auth::user()->id;
        $project = Project::create($fields);

        return response()->json([
            'message' => 'Project successfully created',
            'project' => $project
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return response()->json(['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $fields = $request->only([
            'name', 'deadline', 'finished'
        ]);

        if ($request->has('finished')) {
            if ($project->tasks()->whereNull('finished')->exists()) {
                return response()->json(['errors' => ['finished' => ['The project cannot be finished. Pending tasks.']]], Response::HTTP_BAD_REQUEST);
            }
        }

        $project->update($fields);

        return response()->json([
            'message' => 'Project successfully updated',
            'project' => $project
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json([
            'message' => 'Project successfully deleted',
            'project' => $project
        ]);
    }
}
