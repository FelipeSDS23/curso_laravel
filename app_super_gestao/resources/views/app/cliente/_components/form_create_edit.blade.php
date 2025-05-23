@if (isset($cliente->id))
    <form action="{{ route('cliente.update', ['cliente' => $cliente->id]) }}" method="POST">
        @csrf
        @method('PUT')
@else
    <form action="{{ route('cliente.store') }}" method="POST">
        @csrf
@endif
    
        <input type="text" name="nome" placeholder="Nome" class="borda-preta" value="{{ $cliente->nome ?? old('nome') }}">
        {{ $errors->has('nome') ? $errors->first('nome') : '' }}

        <button type="submit" class="borda-preta">Cadastrar</button>
    </form>
