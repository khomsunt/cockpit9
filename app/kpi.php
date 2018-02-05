<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kpi extends Model
{
    public function index(){
        return view('kpi/index');
    }
}
