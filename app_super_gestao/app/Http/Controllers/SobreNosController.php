<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Middleware\LogAcessoMiddleware;
// use Illuminate\Routing\Controllers\Middleware;

class SobreNosController extends Controller// implements \Illuminate\Routing\Controllers\HasMiddleware
{

    // public static function middleware(): array
    // {
    //     return [
    //         new Middleware(middleware: LogAcessoMiddleware::class),
    //     ];
    // }

    public function sobreNos() {
        return view('site.sobre-nos');
    }
}
