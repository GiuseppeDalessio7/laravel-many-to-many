<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Technology;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Type;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderByDesc('id')->paginate(10);

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_title = 'Add New';
        $project = Project::all();
        $types = Type::all();
        $tecnologies = Technology::all();
        return view('admin.projects.create', compact('page_title', 'types', 'tecnologies', 'project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {

        $val_data = $request->validated();

        $val_data['slug'] = Str::slug($request->title, '-');

        if ($request->has('cover_image')) {

            $complete_path = Storage::disk('public')->put('placeholders', $request->cover_image);
            //$path = strstr($complete_path, '/');
            $val_data['cover_image'] = $complete_path;
        }

        //dd($val_data);
        //dd(Project::create($val_data));
        $newProject = Project::create($val_data);
        $newProject->technologies()->attach($request->technologies);
        // Project::create($val_data);

        return to_route('admin.projects.index')->with('message', 'new project added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.show', compact('project', 'types'));

        // return view('admin.projects.create', compact('types'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('types', 'project', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->all();
        $project->update($data);
        return to_route('admin.projects.index', $project);
        if ($request->has('technologies')) {
            $project->technologies()->sync($request->technologies); // (o valData['technologies'])
        }

        // AGGIORNA L'ENTITA' CON I VALORI DI $valData

        // RIDIRIGE ALLA VISTA DEL DETTAGLIO DELL'ELEMENTO APPENA MODIFICATO
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if (!is_null($project->cover_image)) {
            Storage::delete($project->cover_image);
        }

        // ELIMINA IL RECORD DAL DATABASE
        $project->technologies()->detach();
        $project->delete();


        return to_route('admin.projects.index')->with('message', 'post deleted success!');
    }
}
