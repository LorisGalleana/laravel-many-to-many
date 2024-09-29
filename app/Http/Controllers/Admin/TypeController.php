<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Functions\Helper;
use App\Http\Requests\TypeRequest;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();

        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeRequest $request)
    {

        $exists = Type::where('name', $request->name)->first();

        if(!$exists){
            $data = $request->all();
            $data['slug'] = Helper::generateSlug($data['name'], Type::class);

            $types = Type::create($data);
            return redirect()->route('admin.types.index')->with('success', 'Tipologia inserita con successo');
        }
        else{
            return redirect()->route('admin.types.index')->with('error', 'Tipologia già presente del database');
        }



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeRequest $request, Type $type)
    {
        $data = $request->all();
        $data['slug'] = Helper::generateSlug($data['name'], Type::class);

        $type->update($data);

        return redirect()->route('admin.types.index', $type)->with('message', 'Tipologia modificata correttamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();

        return redirect()->route('admin.types.index', $type)->with('delete', 'La tipologia ' . $type->name . ' è stata eliminata correttamente');
    }

    public function typeProjects(){
        $types = Type::all();

        return view('admin.types.typeProjects', compact('types'));
    }

    public function projectPerType(Type $type){

        return view('admin.types.projectPerType', compact('type'));

    }
}
