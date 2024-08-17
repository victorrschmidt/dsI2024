<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class Home extends Controller
{
    public function index(): View
    {
        $usuarios = DB::table('usuarios')->get();

        return view('home', ['usuarios' => $usuarios]);
    }

    public function deletar($id)
    {
        $db = DB::table('usuarios');
        $db->where('id', '=', $id)->delete();
        $usuarios = $db->get();

        return redirect('/');
    }

    public function adicionar(Request $request)
    {
        $data = $request->all();
        DB::table('usuarios')->insert([
            'nome'      => $data['nome'],
            'sobrenome' => $data['sobrenome'],
            'idade'     => $data['idade']
        ]);

        return redirect('/');
    }
}