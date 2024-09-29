@extends('layouts.app')

@section('content')
    <h1>Elenco progetti</h1>

    <div>
        <form action="{{ route('admin.projects.index') }}" method="GET">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cerca per titolo" name="search" value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">Cerca</button>
            </div>
        </form>
    </div>

    @if(session('delete'))
        <div class="alert alert-success">
            {{ session('delete') }}
        </div>
    @endif

    <table class="table">
        <thead>
          <tr>
            <th scope="col">
                <a href="{{ route('admin.projects.index', ['direction' => $direction, 'column' => 'id']) }}">ID</a>
            </th>
            <th scope="col">Immagine</th>
            <th scope="col">
                <a href="{{ route('admin.projects.index', ['direction' => $direction, 'column' => 'title']) }}">Titolo</a>
            </th>
            <th scope="col">
                <a href="{{ route('admin.projects.index', ['direction' => $direction, 'column' => 'created_at']) }}">Data</a>
            </th>
            <th scope="col">Tipologia</th>
            <th scope="col">Tecnologie</th>
            <th scope="col">Azioni</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project )
                <tr>
                    <td>{{ $project->id }}</td>
                    <td><img class="img-fluid thumb" src="{{ asset('storage/' . $project->path_image) }}" alt="{{ $project->image_original_name }}" onerror="this.src="></td>
                    <td>{{ $project->title }}</td>
                    <td>{{ ( $project->created_at )->format('d/m/Y') }}</td>
                    <td>
                        @if ($project->type)
                        <span class="badge text-bg-success">
                            <a class="text-white" href="{{ route('admin.projectPerType', $project->type) }}">{{ $project->type->name }}</a>
                        </span>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @forelse ($project->technologies as $technology )
                            <span class="badge text-bg-warning">
                                    {{  $technology->name}}
                            </span>
                        @empty
                            -
                        @endforelse
                    </td>
                    <td>
                        <a href="{{ route('admin.projects.show', ['project' => $project->id]) }}" class="btn btn-primary">Dettagli</a>
                        <a href="{{ route('admin.projects.edit', ['project' => $project->id]) }}" class="btn btn-secondary">Modifica</a>
                        @include('admin.partials.formdelete', [
                            'route' => route('admin.projects.destroy', $project),
                            'message' => "Confermi l\'eliminazione del progetto: $project->title ?"
                            ])
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>

      {{ $projects->links() }}
@endsection
