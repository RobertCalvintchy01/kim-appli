<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
  public function index()
{
    $users = \App\Models\User::all();

    return view('users.index', compact('users'));
}

   public function create()
{
    return view('users.create');
}
public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:6',
        'role' => 'required|in:user,admin',
    ]);

    \App\Models\User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => $request->role,
    ]);

    return redirect()
        ->route('users.index')
        ->with('success', 'Utilisateur ajouté avec succès !');
}

 public function show(string $id)
{
    $user = \App\Models\User::findOrFail($id);

    return view('users.show', compact('user'));
}

   public function edit(string $id)
{
    $user = \App\Models\User::findOrFail($id);

    return view('users.edit', compact('user'));
}

  public function update(Request $request, string $id)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'role' => 'required|in:user,admin',
    ]);

    $user = \App\Models\User::findOrFail($id);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->role = $request->role;

    $user->save();

    return redirect()
        ->route('users.index')
        ->with('success', 'Utilisateur modifié avec succès !');
}

    public function destroy(string $id)
{
    $user = \App\Models\User::findOrFail($id);

    $user->delete();

  return redirect()
    ->route('users.index')
    ->with('success', 'Utilisateur supprimé avec succès !');
}
}