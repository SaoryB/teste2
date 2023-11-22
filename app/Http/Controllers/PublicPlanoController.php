<?php

namespace App\Http\Controllers;

use App\Models\Plano;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;

class PublicPlanoController extends Controller
{

    public function index(){
        $planos = Plano::paginate(25);
        Paginator::useBootstrap();
        return view('plano.listapublic', compact('planos'));
    }

}
