<?php

namespace App\Http\Controllers;

use App\Models\Plano;
use App\Models\Horario;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;

class AgendasController extends Controller
{



    public function index()
    {
        $agendas = Agenda::with('plano', 'horario')->paginate(25);
        Paginator::useBootstrap();
        return view('agenda.lista', compact('agendas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $planos = Plano::select('nome', 'id')->pluck('nome', 'id');
        $horarios = Horario::select('data', 'id')->pluck('data', 'id');
        $horarios = Horario::select('hora', 'id')->pluck('hora', 'id');
        return view('agenda.formulario', compact('planos', 'horarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $agenda = new Agenda();
        $agenda->fill($request->all());
        if ($agenda->save()) {
            $tipo = 'mensagem_sucesso';
            $msg = "Agendamento salvo!";
            }
        else {
            $tipo = 'mensagem_erro';
            $msg = 'Deu erro';
        }
        return Redirect::to('agenda/create')
            ->with($tipo, $msg);
    }


    /**
     * Display the specified resource.
     */
    public function show(Agenda $agenda)
    {
        $agenda = Agenda::findOrFail($agenda->id);
        $planos = Plano::select('nome', 'id')->pluck('nome', 'id');
        $horarios = Horario::select('data', 'id')->pluck('data', 'id');
        $horarios = Horario::select('hora', 'id')->pluck('hora', 'id');
        return view('agenda.formulario', compact('planos', 'horarios', 'agenda'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agenda $agenda)
    {
        $agenda = Agenda::findOrFAil($agenda->id);
        $agenda->fill($request->all());

        if ($agenda ->save()) {
            $tipo = 'mensagem_sucesso';
            $msg = "Agendamento alterado!";

        } else {
            $tipo = 'mensagem_erro';
            $msg = 'Deu erro';
        }
        return Redirect::to('agenda/' . $agenda->id)
            ->with($tipo, $msg);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agenda $agenda)
    {
        $agenda = Agenda::findOrFAil($agenda->id);
        $lOk = true;
        if($lOk) {

         if ($agenda->delete()) {
        $tipo = 'mensagem_sucesso';
        $msg = "Agendamento removido!";
         } else {
        $tipo = 'mensagem_erro';
        $msg = 'Deu erro';
    }
}
        return Redirect::to('agenda')->with($tipo, $msg);
    }
}
