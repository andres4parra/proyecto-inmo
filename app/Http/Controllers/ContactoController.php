<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class ContactoController extends Controller
{
    public function index()
    {
        return view('contacto');
    }

    public function enviar(Request $request)
    {
        // 1. Validar los datos de entrada
        // Usamos 'name', 'phone', 'subject' y 'message' para que coincida con la tabla de DB.
        $request->validate([
            'name' => 'required|string|max:255', // Coincide con la columna 'name'
            'phone' => 'required|string|max:10', // Coincide con la columna 'phone' (VARCHAR 10)
            'subject' => 'required|string|max:255', // Coincide con la columna 'subject'
            'message' => 'required|string', // Coincide con la columna 'message' (TEXT)
        ]);

        try {
            // 2. Insertar en la tabla 'messages'
            DB::table('mensajes')->insert([ // Asegúrate de que la tabla se llame 'mensajes' o 'messages'
                // Usamos los nombres de columna de tu DB: name y phone
                'name' => $request->name,
                'phone' => $request->phone, 
                'subject' => $request->subject,
                'message' => $request->message,
                
                // Estos campos son obligatorios por Laravel, pero si usas DB::table, 
                // debes incluirlos manualmente para created_at y updated_at.
                'created_at' => now(), 
                'updated_at' => now(),
            ]);

            // 3. Respuesta exitosa
            return back()->with('success', '¡Tu mensaje ha sido enviado con éxito! Nos pondremos en contacto pronto por WhatsApp o llamada.');

        } catch (\Exception $e) {
            // 4. Manejo de error (ej: si falla la conexión a la DB)
            return back()->with('error', 'Ocurrió un error al intentar guardar tu mensaje. Por favor, inténtalo de nuevo.')->withInput();
        }
    }
}