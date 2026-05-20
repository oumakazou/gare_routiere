<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(Request $request): RedirectResponse
    {
        // 2. Si aucun admin valide n’existe, créer automatiquement cet utilisateur
        if (! \App\Models\User::where('email', 'admin@example.com')->exists()) {
            \App\Models\User::create([
                'nom' => 'Admin User',
                'email' => 'admin@example.com',
                'mot_de_passe' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'admin',
                'is_admin' => true,
            ]);
        }

        // 6. Vérifier que les champs du formulaire login utilisent email et password
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // 4. Vérifier que le login utilise bien Auth::attempt
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $request->boolean('remember'))) {
            $request->session()->regenerate();

            // 8. Après login réussi : redirect()->route('dashboard')
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Les identifiants fournis sont incorrects.',
        ])->onlyInput('email');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
