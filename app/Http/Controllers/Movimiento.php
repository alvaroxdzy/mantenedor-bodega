<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Movimiento extends Controller
{
        public function create()
    {
      // $region = Regions::select('id','name')->get();
      // $comuna = Communes::select('id','name')->get();

        return view('movimientoIngreso');
    }
}
