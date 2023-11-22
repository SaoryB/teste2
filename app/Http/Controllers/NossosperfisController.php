<?php

namespace App\Http\Controllers;

use App\Models\Nossosperfil;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;

class NossosperfisController extends Controller
{

    public function index(){
        $nossosperfis = Nossosperfil::paginate(25);
        Paginator::useBootstrap();
        return view('nossosperfil.lista', compact('nossosperfis'));
    }


    public function create(){
        return view('nossosperfil.formulario');

    }

    public function store(Request $request)
    {
        $this->validate($request, ['image.*', 'mimes:jpeg, jpg, gif, png']);
        $pasta = public_path('/uploads/ofertas');
        if ($request->hasFile('foto')){
            $foto = $request->file('foto');
            $miniatura = Image::make($foto->path());
            $nomeArquivo = $request->file('foto')->getClientOriginalName();
            if(!$miniatura->resize(500,500, function ($constraint){
                $constraint->aspectRatio();
            })
            ->save($pasta.'/'.$nomeArquivo)){
                $nomeArquivo = "semfoto.jpg";
            }
        }else{
            $nomeArquivo='semfoto.jpg';

        }
        $nossosperfil = new Nossosperfil();
        $nossosperfil->fill($request->all());
        if ($nossosperfil->save()) {
            $tipo = 'mensagem_sucesso';
            $msg = "Reserva salvo!";

        } else {
            $tipo = 'mensagem_erro';
            $msg = 'Deu erro';
        }
        return Redirect::to('nossosperfil/create')
            ->with($tipo, $msg);
    }


    public function update(Request $request, Nossosperfil $nossosperfil)
    {
        $nossosperfil = Nossosperfil::findOrFAil($nossosperfil->id);

        $this->validate($request, ['image.*', 'mimes:jpeg, jpg, gif, png']);
        $pasta = public_path('/uploads/ofertas');
        if ($request->hasFile('foto')){
            $foto = $request->file('foto');
            $miniatura = Image::make($foto->path());
            $nomeArquivo = $request->file('foto')->getClientOriginalName();
            if(!$miniatura->resize(500,500, function ($constraint){
                $constraint->aspectRatio();
            })
            ->save($pasta.'/'.$nomeArquivo)){
                $nomeArquivo = "semfoto.jpg";
            }
        }else{
            $nomeArquivo= $nossosperfil->foto;
        }

        $nossosperfil->fill($request->all());

        if ($nossosperfil->save()) {
            $tipo = 'mensagem_sucesso';
            $msg = "Reserva alterado!";

        } else {
            $tipo = 'mensagem_erro';
            $msg = 'Deu erro';
        }
        return Redirect::to('nossosperfil/' . $nossosperfil->id)
            ->with($tipo, $msg);
    }

    public function show($id){
        $nossosperfil = Nossosperfil::findOrFail($id);
        return view('nossosperfil.formulario', compact('nossosperfil'));

    }

    public function destroy(Request $request, $horario_id){
        $nossosperfil = Nossosperfil::findOrFail($horario_id);
        $nossosperfil->delete();
        $request->session()->flash('mensagem_sucesso',
            'Perfil removido com sucesso');
        return Redirect::to('nossosperfil');

    }
}
