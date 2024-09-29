@extends('layouts.app')

@section('content')
    <h1>Gestione tipologie</h1>

    @if(session('delete'))
        <div class="alert alert-success">
            {{ session('delete') }}
        </div>
    @endif
    @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <form class="d-flex justify-content-between mt-5" action="{{ route('admin.types.store') }}" method="POST">
                    @csrf
                    <input type="text" name="name" class="form-control me-3" placeholder="Nuova tipologia">
                    <button class="btn btn-success" type="submit">Aggiungi</button>
                </form>

                <table class="table mt-5">
                    <tbody>
                       @foreach ($types as $type )
                           <tr>
                                <td>
                                    <form action="{{ route('admin.types.update', $type) }}" method="POST" id="form-edit-{{ $type->id }}">
                                        @csrf
                                        @method('PUT')
                                        <input class="input-edit" type="text" name="name" value="{{ $type->name }}">
                                    </form>
                                </td>
                                <td>
                                    <button class="btn btn-warning" type="submit" onclick="submitEditTypeForm({{ $type->id }})">Aggiorna</button>
                                </td>
                                <td>
                                    @include('admin.partials.formdelete',[
                                        'route' => route('admin.types.destroy', $type),
                                        'message' => "Confermi l\'eliminazione della tipologia: $type->name ? "
                                    ])
                                </td>
                           </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function submitEditTypeForm(id){
            const form = document.getElementById(`form-edit-${id}`)
            form.submit();
        }
    </script>



@endsection
