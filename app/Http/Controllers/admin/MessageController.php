<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message; // Asegúrate de que el nombre de tu modelo de mensajes sea 'Message'
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Muestra el listado de todos los mensajes de contacto.
     * Ordena primero por mensajes pendientes y luego por fecha de creación.
     */
    public function index()
    {
        // 1. Obtiene todos los mensajes de la base de datos.
        // 2. Ordena los NO resueltos ('is_resolved' = 0/false) primero (ascendente).
        // 3. Luego ordena por la fecha de creación, del más nuevo al más viejo.
        $messages = Message::orderBy('is_resolved', 'asc') 
                            ->orderBy('created_at', 'desc')
                            ->get();

        // Pasa la colección de mensajes a la vista. ESTO SOLUCIONA EL ERROR.
        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Alterna el estado 'is_resolved' de un mensaje.
     */
    public function resolve(Message $message)
    {
        $message->is_resolved = !$message->is_resolved; // Cambia el estado (true/false)
        $message->save();

        $statusText = $message->is_resolved ? 'resuelto' : 'marcado como pendiente';

        return redirect()->route('admin.messages.index')
                         ->with('success', "El mensaje de {$message->name} ha sido {$statusText} correctamente.");
    }

    /**
     * Muestra los detalles de un mensaje específico (necesitarás la vista 'show').
     */
    public function show(Message $message)
    {
        return view('admin.messages.show', compact('message'));
    }

    /**
     * Elimina un mensaje de la base de datos.
     */
    public function destroy(Message $message)
    {
        $name = $message->name;
        $message->delete();

        return redirect()->route('admin.messages.index')
                         ->with('success', "El mensaje de {$name} ha sido eliminado permanentemente.");
    }
}