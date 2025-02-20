Site da aplicação

@auth
    <h1>Usuário autenticado</h1>
    <p>ID {{ Auth::user()->id }}</p>
    <p>Nome {{ Auth::user()->name }}</p>
    <p>Email {{ Auth::user()->email }}</p>
@endauth

@guest
    <br>
    Olá visitate, tudo bem?
    <br>
    <a href="{{ route('login') }}">login</a>
    <br>
    <a href="{{ route('register') }}">registro</a>
@endguest