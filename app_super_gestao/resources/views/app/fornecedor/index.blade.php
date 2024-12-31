<h3>Fornecedor</h3>

@isset($fornecedores)

    @foreach ($fornecedores as $fornecedor)
    Fornecedor: {{ $fornecedor['nome'] }}
    <br>
    Status: {{ $fornecedor['status']}}
    <br>
    CNPJ: {{ $fornecedor['cnpj'] ?? 'Dado não preenchido' }}
    <hr>
    @endforeach

@endisset