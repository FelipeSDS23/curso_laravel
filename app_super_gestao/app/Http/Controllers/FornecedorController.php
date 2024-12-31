<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index() {
        $fornecedores = [
            [
                'nome' => 'Fornecedor 1',
                'status' => 'N',
                'cnpj' => '12312312312312'
            ],
            [
                'nome' => 'Fornecedor 2',
                'status' => 'S',
                'cnpj' => null
            ],
            [
                'nome' => 'Fornecedor 3',
                'status' => 'S',
                'cnpj' => '12312312312312'
            ]
        ];

        return view('app.fornecedor.index', compact('fornecedores'));
    }
}
