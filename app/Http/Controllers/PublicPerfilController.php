<?php

namespace App\Http\Controllers;

use App\Models\Nossosperfil;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;

class PublicPerfilController extends Controller
{

    public function index(){
        $nossosperfis = Nossosperfil::paginate(25);
        Paginator::useBootstrap();
        return view('nossosperfil.listapublic', compact('nossosperfis'));
    }

}
