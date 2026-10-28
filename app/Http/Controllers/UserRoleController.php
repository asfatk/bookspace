<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->orderBy('name')->paginate(10);

        return view('users.roles', compact('users'));
    }

    public function update(Request $request, User $user)
    {
        abort_if($request->user()->is($user), 403);

        $validated = $request->validate([
            'role' => [
                'required',
                Rule::in(['Admin', 'Dosen', 'Mahasiswa']),
            ],
        ]);

        $role = Role::where('name', $validated['role'])
            ->where('guard_name', 'web')
            ->firstOrFail();

        $user->syncRoles([$role]);

        return back()->with('success', 'Role pengguna berhasil diperbarui.');
    }
}
