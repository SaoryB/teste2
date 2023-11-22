<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;

class HorariosController extends Controller
{

    public function index(){
        $horarios = Horario::paginate(25);
        Paginator::useBootstrap();
        return view('horario.lista', compact('horarios'));
    }


    public function create(){
        return view('horario.formulario');

    }

    public function store(Request $request){
        $horario = new Horario();
        $horario->fill($request->all());
        if ($horario->save()){;
        $request->session()->flash('mensagem_sucesso',"Horario salvo!");
        }else{
        $request->session()->flash('mensagem_erro',"Deu erro!");
        }
        return Redirect::to('horario/create');
    }

    public function update(Request $request, $horario_id){
        $horario = Horario::findOrFail($horario_id);
        $horario->fill($request->all());
        if ($horario->save()){;
        $request->session()->flash('mensagem_sucesso',"Horário alterado!");
        }else{
        $request->session()->flash('mensagem_erro',"Deu erro!");
        }
        return Redirect::to('horario/'.$horario->id);
    }

    public function show($id){
        $horario = Horario::findOrFail($id);
        return view('horario.formulario', compact('horario'));

    }

    public function destroy(Request $request, $horario_id){
        $horario = Horario::findOrFail($horario_id);
        $horario->delete();
        $request->session()->flash('mensagem_sucesso',
            'Horario removido com sucesso');
        return Redirect::to('horario');

    }
}
