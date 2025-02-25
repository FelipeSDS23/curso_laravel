<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function __construct(Marca $marca) {
        $this->marca = $marca;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $marcas = Marca::all();
        $marcas = $this->marca->all();
        
        return response()->json($marcas, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->marca->rules(), $this->marca->feedback());

        // $marca = Marca::create($request->all());
        $marca = $this->marca->create($request->all());

        return response()->json($marca, 201);
    }

    /**
     * Display the specified resource.
     */
    // public function show(Marca $marca)
    public function show($id)
    {
        $marca = $this->marca->find($id);

        if($marca === null) {
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404);
        }

        return response()->json($marca, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Marca $marca)
    public function update(Request $request, $id)
    {
        // $marca->update($request->all());
        $marca = $this->marca->find($id);

        if(!$marca) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach($marca->rules() as $input => $regra) {
                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if(array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas, $this->marca->feedback());
        } else {
            $request->validate($marca->rules(), $this->marca->feedback());
        }

        $marca->update($request->all());
        
        return response()->json($marca, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Marca $marca)
    public function destroy($id)
    {
        $marca = $this->marca->find($id);

        if(!$marca) {
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        }

        $marca->delete();

        return response()->json(['msg' => 'A marca foi removida com sucesso!'], 200);
    }
}
