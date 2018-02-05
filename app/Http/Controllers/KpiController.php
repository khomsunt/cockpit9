<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KpiController extends Controller
{
    public function index(){
        $kpis = \App\kpi::all();
        return view('kpi/index', compact('kpis'));
    }
}