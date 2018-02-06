<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
  public function index(){
      $fullname="Khomkrit Kaewma";
      $website="skko.moph.go.th";
      return view('aum.about',[
          'fullname'=>$fullname,
          'website'=>$website
      ]);
  }
}
