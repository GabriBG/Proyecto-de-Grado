<?php

namespace App\Http\Controllers;

class InicioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('inicio');
    }
    public function reportes()
    {
        return view('reportes');
    }
    public function reporteAsistencia()
    {
        return view('reportesAsistencia');
    }
}
