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
        <li>Tecnologia:
            @forelse ($project->technologies as $technology )
                <span class="badge text-bg-warning">{{$technology->name}}</span>
            @empty
                NESSUNA TECNOLOGIA
            @endforelse
        </li>
        <li>Descrizione: {{ $project->text }} </li>
        <li>Data creazione: {{ ( $project->created_at )->format('d/m/Y') }} </li>
        <li>Data ultima modifica: {{ ( $project->updated_at )->format('d/m/Y') }} </li>
    </ul>
    <div class="container">
        <img class="img-fluid" src="{{ asset('storage/' . $project->path_image) }}" alt="{{ $project->image_original_name }}" onerror="this.src='/img/no-image.png'">
        <p>{{ $project->image_original_name }}</p>
    </div>
    <a href="{{ route('admin.projects.index') }}" class="btn btn-primary">Torna all'elenco</a>

@endsection
