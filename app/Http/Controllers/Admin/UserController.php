<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::query()->orderByDesc('id')->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'mot_de_passe' => ['required', 'string', 'min:8'],
            'role' => ['nullable', 'string', 'max:50'],
            'is_admin' => ['nullable', 'boolean'],
        ]);

        User::create([
            'nom' => $data['nom'],
            'email' => $data['email'],
            'mot_de_passe' => $data['mot_de_passe'],
            'role' => $data['role'] ?? null,
            'is_admin' => $request->boolean('is_admin'),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur créé.');
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'mot_de_passe' => ['nullable', 'string', 'min:8'],
            'role' => ['nullable', 'string', 'max:50'],
            'is_admin' => ['nullable', 'boolean'],
        ]);

        $payload = [
            'nom' => $data['nom'],
            'email' => $data['email'],
            'role' => $data['role'] ?? null,
            'is_admin' => $request->boolean('is_admin'),
        ];

        if (! empty($data['mot_de_passe'])) {
            $payload['mot_de_passe'] = $data['mot_de_passe'];
        }

        $user->update($payload);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour.');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        if ($user->id === $request->user()?->id) {
            return redirect()->route('admin.users.index')->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé.');
    }
}
