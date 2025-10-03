<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function index()
    {
        return view('contacto');
    }

    public function enviar(Request $request)
    {
        // Aquí más adelante puedes procesar el formulario de contacto
        // Ejemplo: enviar correo o guardar en base de datos
        return back()->with('success', 'Tu mensaje ha sido enviado correctamente.');
    }
}
