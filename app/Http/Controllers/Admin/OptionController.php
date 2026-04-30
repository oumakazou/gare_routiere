<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OptionController extends Controller
{
    public function index(): View
    {
        return view('admin.options.index', ['options' => Option::orderBy('nom')->get()]);
    }

    public function create(): View
    {
        return view('admin.options.form', ['option' => new Option()]);
    }

    public function store(Request $request)
    {
        $request->validate(['nom' => ['required', 'string', 'max:255', 'unique:options,nom']]);

        Option::create($request->only('nom'));

        return redirect()->route('admin.options.index')->with('success', 'Option créée.');
    }

    public function edit(Option $option): View
    {
        return view('admin.options.form', compact('option'));
    }

    public function update(Request $request, Option $option)
    {
        $request->validate(['nom' => ['required', 'string', 'max:255', 'unique:options,nom,' . $option->id]]);

        $option->update($request->only('nom'));

        return redirect()->route('admin.options.index')->with('success', 'Option mise à jour.');
    }

    public function destroy(Option $option)
    {
        $option->delete();

        return redirect()->route('admin.options.index')->with('success', 'Option supprimée.');
    }
}
