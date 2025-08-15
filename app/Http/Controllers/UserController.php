<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAdminRequest;
use App\Http\Requests\UserAdminUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::whereHas('role', function ($query) {
            $query->where('role_name', '!=', 'customer');
        })->orderBy('fullname', 'asc')->get();

        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();

        return view('admin.user.create',  compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserAdminRequest $request)
    {
        // Validate the request data using UserAdminRequest class
        $validated_data = $request->validated();

        //  encrypt password
        $validated_data['password'] = bcrypt($validated_data['password']);

        //Create a new user
        User::create($validated_data);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan');
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
        $user =  User::findOrFail($id);
        $roles = Role::all();

        return view('admin.user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserAdminUpdateRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $validated_data = $request->validated();

        $user->update($validated_data);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        $message = 'User ' . $user->username . ' berhasil dihapus';

        return redirect()->route('admin.users.index')
            ->with('success', $message);
    }
}
