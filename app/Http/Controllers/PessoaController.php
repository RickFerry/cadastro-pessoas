<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PessoaController extends Controller
{
    public function index(Request $request): Response
    {
        $pessoas = Pessoa::query()
            ->when($request->input('cpf'), function ($query, $cpf) {
                $query->where('cpf', 'like', "%{$cpf}%");
            })
            ->get();

        return Inertia::render('Pessoas/Index', [
            'pessoas' => $pessoas,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Pessoas/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $pessoa = Pessoa::create($request->all());

        return redirect()->route('pessoas.show', $pessoa->id);
    }

    public function show($id): Response
    {
        $pessoa = Pessoa::with('enderecos')->findOrFail($id);

        return Inertia::render('Pessoas/Show', [
            'pessoa' => $pessoa,
            'enderecos' => $pessoa->enderecos,
        ]);
    }

    public function edit($id): Response
    {
        $pessoa = Pessoa::findOrFail($id);

        return Inertia::render('Pessoas/Edit', [
            'pessoa' => $pessoa,
        ]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $pessoa = Pessoa::findOrFail($id);
        $pessoa->update($request->all());

        return redirect()->route('pessoas.show', $id);
    }
}
