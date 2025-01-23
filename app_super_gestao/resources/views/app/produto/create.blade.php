@extends('app.layouts.basico')

@section('titulo', 'Produto')

@section('conteudo')

    <div class="conteudo-pagina">

        <div class="titulo-pagina-2">
            <p>Adicionar Produto</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('produto.index') }}">Voltar</a></li>
                <li><a href="">Consulta</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width: 30%; margin: auto;">
                <form action="" method="POST">
                    @csrf
                    <input type="text" name="nome" placeholder="Nome" class="borda-preta" value="">

                    <input type="text" name="descricao" placeholder="Descrição" class="borda-preta" value="">
                    
                    <input type="text" name="peso" placeholder="Peso" class="borda-preta" value="">
                    
                    <select name="unidade_id">
                        <option>-- Selecione a Unidade de Medida --</option>
                        @foreach ($unidades as $unidade)
                        <option value="{{ $unidade->id }}">{{ $unidade->descricao }}</option>
                        @endforeach
                    </select>
                    
                    <button type="submit" class="borda-preta">Cadastrar</button>
                </form>
            </div>
        </div>

    </div>

@endsection