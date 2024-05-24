<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderByDesc('id')->paginate(8);

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $validated = $request->validated();

        $slug = Str::slug($request['name']);

        dd($slug);
        
        $validated['slug'] = $slug;
        
        if ($request->has('preview_image')) {

            $img_path = Storage::put('uploads', $validated['preview_image']);
            $validated['preview_image'] = $img_path;
        }


        Project::create($validated);
        return to_route('admin.projects.index')->with('message', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project, Type $type)
    {
        $types = Type::all();

        return view('admin.projects.show', compact('project', 'type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project, Type $type)
    {
        $types = Type::all();
        return view('admin.projects.edit', compact('project','types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $validated = $request->validated();


        if ($request->has('preview_image')) {

            // dd($request->all());

            if ($project->preview_image) {
                Storage::delete($project->preview_image);
            }

            $image_path = Storage::put('uploads', $validated['preview_image']);
            $validated['preview_image'] = $image_path;
        }


        $project->update($validated);
        return to_route('admin.projects.show', compact('project'))->with('message', 'Post modified successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return to_route('admin.projects.index')->with('message', "Post $project->title deleted successfully");
    }
}
