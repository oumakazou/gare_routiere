<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Voyage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class PageController extends Controller
{
    public function touristique()
    {
        $voyages = Schema::hasTable('voyages') ? Voyage::all() : collect();

        return view('pages.touristique', compact('voyages'));
    }

    public function messagerie()
    {
        return view('pages.messagerie');
    }

    public function gareInspiration()
    {
        return view('pages.gare-inspiration');
    }

    public function quiNousSommes()
    {
        return view('pages.qui-nous-sommes');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function submitMessagerie(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:120'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        Log::info('Messaging form submission', $validated);

        return redirect()
            ->route('messagerie')
            ->with('success', 'Votre message a bien ete envoye. Notre equipe revient vers vous rapidement.');
    }

    public function submitContact(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'subject' => ['required', 'string', 'max:100'],
            'message' => ['required', 'string', 'max:5000'],
            'newsletter' => ['nullable', 'accepted'],
        ]);

        Log::info('Contact form submission', [
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'newsletter' => $request->boolean('newsletter'),
        ]);

        return redirect()
            ->route('contact')
            ->with('success', 'Votre demande a bien ete envoyee. Notre equipe vous repondra rapidement.');
    }
}
