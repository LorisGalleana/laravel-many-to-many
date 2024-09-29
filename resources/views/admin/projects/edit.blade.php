@extends('layouts.app')

@section('content')
    <h1>Modifica progetto: {{ $project->title }} </h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.projects.update', $project) }}" method="post">
        @csrf
        @method('PUT')
        {{-- TITOLO --}}
        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror " id="title" name="title" value="{{ old('title', $project->title) }}">
            @error('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        {{-- TIPOLOGIA --}}
        <div class="mb-3">
            <label for="type" class="form-label">Tipologia</label>
            <select name="type_id" class="form-select" aria-label="Default select example" id="type">
                <option value="">Seleziona una tipologia</option>
                @foreach ($types as $type )
                <option value="{{ $type->id }}" @if (old('type_id', $project->type?->id) == $type->id) selected @endif>{{ $type->name }}</option>
                @endforeach
            </select>
        </div>
        {{-- DESCRIZIONE --}}
        <div class="mb-3">
            <label for="content" class="form-label">Descrizione</label>
            <textarea class="form-control @error('text') is-invalid @enderror" id="text" name="text" rows="6">{{ old('text', $project->text) }}</textarea>
            @error('text')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Aggiorna</button>
    </form>

@endsection
