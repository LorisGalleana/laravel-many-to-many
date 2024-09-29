<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;
use App\Functions\Helper;
use App\Http\Requests\ProjectsRequest;
use App\Models\Technology;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderBy('id', 'desc')->paginate(15);

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectsRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Helper::generateSlug($data['title'], Project::class);

        $project = Project::create($data);

        if(array_key_exists('technologies', $data)){
            $project->technologies()->attach($data['technologies']);
        }

        return redirect()->route('admin.projects.show', $project);

    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectsRequest $request, Project $project)
    {
        $data = $request->all();
        if($data['title'] != $project->title){
            $data['slug'] = Helper::generateSlug($data['title'], Project::class);
        }

        $project->update($data);

        if(array_key_exists('technologies', $data)){
            // ->sync() aggiunge le relazioni mancanti e cancella quelle che non esistono più
            $project->technologies()->sync($data['technologies']);
        }
        else{
            // se non vengono inviate le tecnologie, devo cancellare tutte le relazioni
            // ->detach() elimina tutte le relazioni
            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show', $project)->with('message', 'Progetto modificato correttamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')->with('delete', 'Il progetto ' . $project->title . ' è stato eliminato correttamente');
    }
}
