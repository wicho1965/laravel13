<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserWebController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ]);

    $validated['password'] = bcrypt($validated['password']);

    User::create($validated);

    return redirect('/users')
        ->with('success', 'Usuario creado correctamente');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $user = User::findOrFail($id);

    return view('users.edit', compact('user'));
}

public function update(Request $request, string $id)
{
    $user = User::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
    ]);

    $user->update($validated);

    return redirect('/users')
        ->with('success', 'Usuario actualizado correctamente');
}

public function destroy(string $id)
{
    $user = User::findOrFail($id);

    $user->delete();

    return redirect('/users')
        ->with('success', 'Usuario eliminado correctamente');
}

}
