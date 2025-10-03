<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Propiedad;

class PropiedadController extends Controller
{
    public function index()
    {
        // Traemos todas las propiedades
        $propiedades = Propiedad::all();

        // Pasamos los datos a la vista
        return view('propiedades.index', compact('propiedades'));
    }
}
