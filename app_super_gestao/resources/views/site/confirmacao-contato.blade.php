@extends('site.layouts.basico')

@section('titulo', $titulo)

@section('conteudo')

<div class="conteudo-pagina">
    <div class="titulo-pagina">
        <h1>Sua mensagem foi enviada com sucesso! Entraremos em contato o mais breve possível.</h1>
        <p><a href={{ route('site.index') }}>Clique aqui</a> para voltar a página inial.</p>
    </div>
</div>

<div class="rodape">
    <div class="redes-sociais">
        <h2>Redes sociais</h2>
        <img src={{ asset('img/facebook.png') }}>
        <img src={{ asset('img/linkedin.png') }}>
        <img src={{ asset('img/youtube.png') }}>
    </div>
    <div class="area-contato">
        <h2>Contato</h2>
        <span>(11) 3333-4444</span>
        <br>
        <span>supergestao@dominio.com.br</span>
    </div>
    <div class="localizacao">
        <h2>Localização</h2>
        <img src={{ asset('img/mapa.png') }}>
    </div>
</div>
@endsection