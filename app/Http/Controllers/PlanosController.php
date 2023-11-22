<?php

namespace App\Http\Controllers;

use App\Models\Plano;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;

class PlanosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listar(){


    $planos = Plano::paginate(25);
    Paginator::useBootstrap();

    return view('plano.lista', compact('planos'));

}
    public function create(){
        return view('plano.formulario');
    }

    public function store(Request $request){
        $plano = new Plano();
        $plano->fill($request->all());
        if ($plano->save()){
            $request->session()->flash('mensagem_sucesso', "Plano salvo!");
        } else {
            $request->session()->flash('mensagem_erro', 'Deu erro');
        }
        return Redirect::to('plano/create');
    }

    public function update(Request $request, $plano_id){
        $plano = Plano::findOrFail($plano_id);
        $plano->fill($request->all());
        if ($plano->save()){
            $request->session()->flash('mensagem_sucesso', "Plano alterado!");
        } else {
            $request->session()->flash('mensagem_erro', 'Deu erro');
        }
        return Redirect::to('plano/'.$plano->id);
    }

    public function show($id){
        $plano = Plano::findOrFail($id);
        return view('plano.formulario', compact('plano'));
    }

    public function deletar(Request $request, $plano_id){
        $plano = Plano::findOrFail($plano_id);
        $plano->delete();
        $request->session()->flash('mensagem_sucesso',
            'Plano removido com sucesso');
        return Redirect::to('plano');
    }

    public function showReport(){
    $planos = Plano::get();
    $pdf = Pdf::loadView('reports.planos', compact('planos'));

    $pdf->setPaper('a4', 'portrait')
        ->setOptions(['dpi'=>150, 'defaultFont'=>'sans-serif'])
        ->setEncryption('123');

    return $pdf
    //download('relatorio.pdf');
    //->save(public_path('/arquivos/relatorio.pdf'));
    ->stream('relatorio.pdf');
}
}
