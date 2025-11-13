<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User; // Asumiendo que usas el modelo User por defecto

class UserController extends Controller
{
    /**
     * Muestra el perfil del usuario autenticado (si no estás usando ProfileController).
     */
    public function showProfile()
    {
        // Esto solo es necesario si no usas el ProfileController de Jetstream/Breeze
        $user = Auth::user();

        // Podrías retornar una vista pública del perfil
        return view('user.profile.show', compact('user'));
    }

    /**
     * Muestra el formulario para editar el perfil del usuario.
     */
    public function editProfile()
    {
        $user = Auth::user();
        return view('user.profile.edit', compact('user'));
    }

    /**
     * Actualiza el perfil del usuario autenticado.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Reglas de validación
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Perfil actualizado exitosamente.');
    }

    // Si tu aplicación no necesita estos métodos, pueden omitirse.
}