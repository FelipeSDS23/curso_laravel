<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\NovaTarefaMail;

class TarefaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $tarefas = Tarefa::where('user_id', $user_id)->paginate(10);
        return view('tarefa.index', ['tarefas' => $tarefas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tarefa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $rules = [
            'tarefa' => 'required|string|min:3|max:200', // Obrigatório, texto, mínimo 3 caracteres, máximo 200
            'data_limite_conclusao' => 'required|date|after_or_equal:today' // Obrigatório, data válida, deve ser hoje ou no futuro
        ];
        
        $feedback = [
            'tarefa.required' => 'O campo tarefa é obrigatório.',
            'tarefa.string' => 'A tarefa deve ser um texto.',
            'tarefa.min' => 'A tarefa deve ter pelo menos 3 caracteres.',
            'tarefa.max' => 'A tarefa deve ter no máximo 200 caracteres.',
            'data_limite_conclusao.required' => 'O campo data limite é obrigatório.',
            'data_limite_conclusao.date' => 'A data limite deve ser uma data válida.',
            'data_limite_conclusao.after_or_equal' => 'A data limite não pode ser no passado.'
        ];
        
        $request->validate($rules, $feedback);

        $dados = $request->all('tarefa', 'data_limite_conclusao');
        $dados['user_id'] = Auth::user()->id;
        $tarefa = Tarefa::create($dados);

        $destinatario = Auth::user()->email;

        $assunto = "Nova tarefa criada";

        Mail::to($destinatario)->send(new NovaTarefaMail($tarefa, $assunto));
        
        return redirect()->route('tarefa.show', ['tarefa' => $tarefa->id]);
    }   

    /**
     * Display the specified resource.
     */
    public function show(Tarefa $tarefa)
    {
        return view('tarefa.show', ['tarefa' => $tarefa]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarefa $tarefa)
    {

        $user_id = Auth::user()->id;
        $tarefa_id = $tarefa->user_id;

        if($tarefa_id == $user_id) {
            return view('tarefa.edit', ['tarefa' => $tarefa]);
        }

        return view('acesso-negado');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarefa $tarefa)
    {

        $rules = [
            'tarefa' => 'required|string|min:3|max:200', // Obrigatório, texto, mínimo 3 caracteres, máximo 200
            'data_limite_conclusao' => 'required|date|after_or_equal:today' // Obrigatório, data válida, deve ser hoje ou no futuro
        ];
        
        $feedback = [
            'tarefa.required' => 'O campo tarefa é obrigatório.',
            'tarefa.string' => 'A tarefa deve ser um texto.',
            'tarefa.min' => 'A tarefa deve ter pelo menos 3 caracteres.',
            'tarefa.max' => 'A tarefa deve ter no máximo 200 caracteres.',
            'data_limite_conclusao.required' => 'O campo data limite é obrigatório.',
            'data_limite_conclusao.date' => 'A data limite deve ser uma data válida.',
            'data_limite_conclusao.after_or_equal' => 'A data limite não pode ser no passado.'
        ];
        
        $request->validate($rules, $feedback);

        $user_id = Auth::user()->id;
        $tarefa_id = $tarefa->user_id;
        if(!$tarefa_id == $user_id) {
            return view('acesso-negado');
        }

        $tarefa->update($request->all());
        return redirect()->route('tarefa.show', ['tarefa' => $tarefa->id]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarefa $tarefa)
    {

        $user_id = Auth::user()->id;
        $tarefa_id = $tarefa->user_id;
        if(!$tarefa_id == $user_id) {
            return view('acesso-negado');
        }

        $tarefa->delete();

        return redirect()->route('tarefa.index');
    }
}
