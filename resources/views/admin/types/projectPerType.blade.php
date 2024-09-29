@extends('layouts.app')

@section('content')
    <h1>Elenco progetti per la tipologia: {{ $type->name }} </h1>


        <ul class="list-group">
            @foreach ($type->projects as $project )
                <li class="list-group-item d-flex justify-content-between">
                    <span>
                        {{$project->title}}
                    </span>
                    <a href="{{ route('admin.projects.show', $project) }} " class="btn btn-warning">Vedi</a>
                </li>
            @endforeach
        </ul>


@endsection
