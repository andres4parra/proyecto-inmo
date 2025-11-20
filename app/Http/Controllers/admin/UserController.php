<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Rol::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email|unique:usuarios,email',
            'password'  => 'required|min:6',
            'roles'     => 'required|array',
        ]);

        $usuario = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'direccion' => $request->direccion,
            'password'  => Hash::make($request->password),
        ]);

        $usuario->roles()->sync($request->roles);

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario creado correctamente');
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $roles = Rol::all();

        return view('admin.users.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $request->validate([
            'name'      => 'required',
            'email'     => "required|email|unique:usuarios,email,$id",
            'roles'     => 'required|array',
        ]);

        $usuario->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'direccion' => $request->direccion,
        ]);

        if (!empty($request->password)) {
            $usuario->password = Hash::make($request->password);
            $usuario->save();
        }

        // actualizar roles
        $usuario->roles()->sync($request->roles);

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy($id)
    {
        $usuario = User::findOrFail($id);

        $usuario->roles()->detach();
        $usuario->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario eliminado correctamente');
    }
}
