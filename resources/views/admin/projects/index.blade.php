@extends('layouts.app')

@section('content')
    <h1>Elenco progetti</h1>

    @if(session('delete'))
        <div class="alert alert-success">
            {{ session('delete') }}
        </div>
    @endif

    <table class="table">
        <thead>
          <tr>
            <th scope="col"># ID</th>
            <th scope="col">Titolo</th>
            <th scope="col">Data</th>
            <th scope="col">Tipologia</th>
            <th scope="col">Azioni</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project )
                <tr>
                    <td>{{ $project->id }}</td>
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
