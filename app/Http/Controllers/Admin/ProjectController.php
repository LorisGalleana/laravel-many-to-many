<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;
use App\Functions\Helper;
use App\Http\Requests\ProjectsRequest;
use App\Models\Technology;
use Illuminate\Support\Facades\Storage;



class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if(isset($_GET['direction'])){
            $direction = $_GET['direction'] == 'asc' ? 'desc' : 'asc';
        }
        else{
            $direction = 'desc';
        }
        if(isset($_GET['column'])){
            $column = $_GET['column'];
            $projects = Project::orderBy($column, $direction)->paginate(15);
        }
        else{
            $projects = Project::orderBy('id', 'desc')->paginate(15);
        }

        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $projects = Project::where('title', 'LIKE', '%' . $search . '%')->orderBy('id', 'desc')->paginate(15);
            $projects->appends(request()->query());
            return view('admin.projects.index', compact('projects', 'direction'));
        }



        return view('admin.projects.index', compact('projects', 'direction'));
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

        // verifico se viene caricata l'immagine ossia es esiste la chiava path_image
        if(array_key_exists('path_image', $data)){
            // se esiste la chiave
            //salvo l'immagine nello storage
            $image_path = Storage::put('uploads', $data['path_image']);
            // ottengo il nome originale dell'immagine
            $original_name = $request->file('path_image')->getClientOriginalName();
            // aggiungo i valori a $data
            $data['path_image'] = $image_path;
            $data['image_original_name'] = $original_name;

        }

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

        if(array_key_exists('path_image', $data)){
            // se esiste la chiave
            // elimino la vecchia immagine se c'è
            if($project->path_image){
                Storage::delete($project->path_image);
            }
            //salvo l'immagine nello storage
            $image_path = Storage::put('uploads', $data['path_image']);
            // ottengo il nome originale dell'immagine
            $original_name = $request->file('path_image')->getClientOriginalName();
            // aggiungo i valori a $data
            $data['path_image'] = $image_path;
            $data['image_original_name'] = $original_name;

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

        if($project->path_image){
            Storage::delete($project->path_image);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('delete', 'Il progetto ' . $project->title . ' è stato eliminato correttamente');
    }
}
