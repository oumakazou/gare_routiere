<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function index(): View
    {
        return view('admin.settings.index');
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'site_name' => ['nullable', 'string', 'max:255'],
        ]);

        return redirect()->route('admin.settings.index')->with('success', 'Paramètres enregistrés.');
    }
}
