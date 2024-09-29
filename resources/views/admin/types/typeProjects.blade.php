@extends('layouts.app')

@section('content')
    <h1>Elenco progetti per tipologia</h1>

    @foreach ($types as $type )
        <h2 class="mt-5">{{$type->name}}</h2>
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
    @endforeach
@endsection
