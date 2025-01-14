{{ $slot }}
<form action={{ route('site.contato') }} method="POST">
    @csrf
    <input name="nome" type="text" placeholder="Nome" class={{ $classe }} required value="{{ old('nome') }}">
    <br>
    <input name="telefone" type="text" placeholder="Telefone" class={{ $classe }} value="{{ old('telefone') }}">
    <br>
    <input name="email" type="text" placeholder="E-mail" class={{ $classe }} value="{{ old('email') }}">
    <br>
    <select name="motivo_contato" class={{ $classe }}>
        <option value="0">Qual o motivo do contato?</option>

        @foreach ($motivo_contatos as $key => $motivo_contato)
            <option value="{{ $key }}" {{ old('motivo_contato') == $key ? 'selected' : '' }}>{{$motivo_contato}}</option>
        @endforeach
    </select>
    <br>
    <textarea name="mensagem" class={{ $classe }}>{{ (old('mensagem') != '') ? old('mensagem') : 'Preencha aqui a sua mensagem' }}</textarea>
    <br>
    <button type="submit" class={{ $classe }}>ENVIAR</button>
</form>

<div style="position: absolute; top:0px; left:0px; width:100%; background:red">
    <pre>
        {{ $errors }}
    </pre>
</div>