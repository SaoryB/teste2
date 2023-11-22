<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
}
