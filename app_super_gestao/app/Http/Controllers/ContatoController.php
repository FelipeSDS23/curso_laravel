<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SiteContato;
use App\Models\MotivoContato;

class ContatoController extends Controller
{
    public function contato(Request $request) {

        $motivo_contatos = MotivoContato::all();

        return view('site.contato', ['titulo' => 'Contato', 'motivo_contatos' => $motivo_contatos]);
    }

    public function salvar(Request $request) {

        //realizar a validação dos 
        $request->validate([
            'nome' => 'required|min:3|max:40',
            'telefone' => 'required',
            'email' => 'email',
            'motivo_contatos_id' => 'required',
            'mensagem' => 'required|max:2000'
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.min' => 'O nome deve ter no mínimo :min caracteres.',
            'nome.max' => 'O nome pode ter no máximo :max caracteres.',
            'telefone.required' => 'O campo telefone é obrigatório.',
            'email.email' => 'Por favor, informe um endereço de e-mail válido.',
            'motivo_contatos_id.required' => 'O motivo do contato é obrigatório.',
            'mensagem.required' => 'O campo mensagem é obrigatório.',
            'mensagem.max' => 'A mensagem pode ter no máximo :max caracteres.',
        ]);        

        SiteContato::create($request->all());
        return redirect()->route('site.contato.confirmacao');
    }

    public function confirmacao() {
        return view('site.confirmacao-contato', ['titulo' => 'Mensagem enviada']);
    }
}
