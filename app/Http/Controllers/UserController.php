<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Lista utenti
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Form di creazione
    public function create()
    {
        $roles = User::getRoles();
        return view('users.edit', compact('roles'));
    }

    // Salvataggio nuovo utente
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'Utente creato con successo!');
    }

    // Form di modifica
    public function edit(User $user)
    {
        $roles = User::getRoles();
        return view('users.edit', compact('user', 'roles'));
    }

    // Aggiornamento utente
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|string'
        ]);

        if(!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'Utente aggiornato con successo!');
    }

    // Eliminazione utente
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Utente eliminato!');
    }
}
