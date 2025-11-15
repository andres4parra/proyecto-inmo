<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // =================================================================
    // MÉTODOS DE GESTIÓN DE PERFIL DEL USUARIO AUTENTICADO (TUS MÉTODOS ORIGINALES)
    // =================================================================

    /**
     * Muestra el perfil del usuario autenticado (si no estás usando ProfileController).
     */
    public function showProfile()
    {
        $user = Auth::user();
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
            // La validación de email ignora el ID del usuario actual
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id, 
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        
        if ($request->filled('password')) {
            // CORRECCIÓN: Usamos Hash::make() en lugar de bcrypt() para la mejor práctica de Laravel
            $user->password = Hash::make($request->input('password')); 
        }

        $user->save(); // El save() es correcto

        // Asegúrate que esta ruta 'profile.show' esté definida
        return redirect()->route('profile.show')->with('success', 'Perfil actualizado exitosamente.');
    }

    // =================================================================
    // MÉTODOS DE GESTIÓN DE USUARIOS (CRUD DE ADMINISTRACIÓN) - NUEVOS MÉTODOS
    // =================================================================

    /**
     * Muestra una lista de todos los usuarios (Index para Admin).
     */
    public function index()
    {
        // Obtiene todos los usuarios, ordenados por el más reciente
        $users = User::latest()->get(); 
        return view('admin.users.index', compact('users'));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        // Define roles para el formulario de creación
        $roles = [
            'admin' => 'Administrador',
            'agent' => 'Agente Inmobiliario',
            'client' => 'Cliente',
        ];
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Almacena un usuario recién creado en la base de datos.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users', 
            'password' => 'required|string|min:8|confirmed', 
            // 'role' => ['required', Rule::in(['admin', 'agent', 'client'])], // Descomentar si usas roles
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'role' => $request->role, 
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Muestra el formulario para editar un usuario existente.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        
        $roles = [
            'admin' => 'Administrador',
            'agent' => 'Agente Inmobiliario',
            'client' => 'Cliente',
        ];

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Actualiza un usuario existente en la base de datos.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)], 
            'password' => 'nullable|string|min:8|confirmed', 
            // 'role' => ['required', Rule::in(['admin', 'agent', 'client'])],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $data = $request->only(['name', 'email']);
        // $data['role'] = $request->role; 

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Elimina un usuario de la base de datos.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        
        if ($user->id === auth()->id()) {
             return redirect()->back()->with('error', 'No puedes eliminar tu propia cuenta.');
        }
        
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}