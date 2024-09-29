<form class="d-inline" action="{{ $route }}" method="post" onsubmit="return confirm('{{ $message }}' )">
    @csrf
    @method('DELETE')
    <input type="submit" value="Elimina" class="btn btn-danger">
</form>
