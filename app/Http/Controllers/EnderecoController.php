<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Pessoa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EnderecoController extends Controller
{
    public function create($pessoaId): Response
    {
        $pessoa = Pessoa::findOrFail($pessoaId);

        return Inertia::render('Enderecos/Create', [
            'pessoa' => $pessoa,
        ]);
    }

    public function store(Request $request, $pessoaId): RedirectResponse
    {
        $pessoa = Pessoa::findOrFail($pessoaId);
        $endereco = $pessoa->enderecos()->create($request->all());

        return redirect()->route('pessoas.show', $pessoaId);
    }

    public function edit($id): Response
    {
        $endereco = Endereco::findOrFail($id);

        return Inertia::render('Enderecos/Edit', [
            'endereco' => $endereco,
        ]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $endereco = Endereco::findOrFail($id);
        $endereco->update($request->all());

        return redirect()->route('pessoas.show', $endereco->pessoa_id);
    }
}
