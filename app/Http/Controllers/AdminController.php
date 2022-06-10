<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function adminBitacora(Request $request){

        return view('paginas.admin.bitacora');
    }
}
