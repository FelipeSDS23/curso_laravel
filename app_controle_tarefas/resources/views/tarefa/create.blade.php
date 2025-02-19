@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Adicionar tarefa') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('tarefa.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Tarefa</label>
                                <input type="text" class="form-control" name="tarefa" required>
                                @if ($errors->has('tarefa'))
                                    <span class="text-red-500">{{ $errors->first('tarefa') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Data limite conclusão</label>
                                <input type="date" class="form-control" name="data_limite_conclusao" required>
                                @if ($errors->has('data_limite_conclusao'))
                                    <span class="text-red-500">{{ $errors->first('data_limite_conclusao') }}</span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
