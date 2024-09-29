@extends('layouts.app')

@section('content')

    @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <h1>Dettagli progetto</h1>
    <div>
        <a href="{{ route('admin.projects.edit', ['project' => $project->id]) }}" class="btn btn-secondary">Modifica</a>
        @include('admin.partials.formdelete', [
                            'route' => route('admin.projects.destroy', $project),
                            'message' => "Confermi l\'eliminazione del progetto: $project->title ?"
                            ])
    </div>
    <ul>
        <h3>Titolo: {{ $project->title }} </h3>
        <li>Tipologia: {{ $project->type ? $project->type->name : 'NESSUNA CATEGORIA' }} </li>
        <li>Descrizione: {{ $project->text }} </li>
        <li>Data creazione: {{ ( $project->created_at )->format('d/m/Y') }} </li>
        <li>Data ultima modifica: {{ ( $project->updated_at )->format('d/m/Y') }} </li>
    </ul>
    <a href="{{ route('admin.projects.index') }}" class="btn btn-primary">Torna all'elenco</a>

@endsection
