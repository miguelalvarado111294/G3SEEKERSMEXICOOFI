<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(User $user)
    {
        //
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validar que se envían roles
        $request->validate([
            'roles' => 'array',
            'roles.*' => 'exists:roles,id',
        ]);
    
        // Sincronizar los roles del usuario
        $user->roles()->sync($request->roles);
    
        // Redirigir con un mensaje de éxito
        return redirect()->route('admin.users.index')->with('success', 'Roles asignados con éxito.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)

    {
        $user = User::destroy($user->id);
        $users=User::all();
        return view('admin.users.index',compact('users'));
        //
    }
}
