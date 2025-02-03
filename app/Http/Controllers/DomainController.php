<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $domains = Domain::query()
            ->when(request('search'), function($query) {
                return $query
                    ->where('domain', 'like', '%'.request('search').'%')
                    ->orWhere('owner', 'like', '%'.request('search').'%');
            })
            ->orderBy(request('sort_by', 'domain'), request('sort_dir', 'asc'))
            ->paginate(10);
        //$domains = Domain::orderBy('domain', 'asc')->paginate(10);
        return view('domains', compact('domains'));
    }

    public function store(Request $request, Domain $domain)
    {
        try {
            $request->validate([
                'domain' => 'required|unique:domains,domain',
                'owner' => 'string|max:255',
                'owner_email' => 'email',+
                'nserver' => 'nullable|string',
                'expires_date' => 'date',
            ]);

            $domain->create($request->all());

            return redirect()->route('domains.index')->with('success', 'Domínio cadastrado com sucesso!');

        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Erro ao criar o domínio: ' . $exception->getMessage());
        }
    }

    public function update(Request $request, Domain $domain)
    {

        try {
            $request->validate([
                'domain' => 'required|unique:domains,domain,' . $domain->id,
                'owner' => 'required|string|max:255',
                'owner_email' => 'nullable|email',
                'nserver' => 'nullable|string',
                'expires_date' => 'nullable|date',
            ]);

            $domain->update($request->all());

            return redirect()->route('domains.index')->with('success', 'Domínio atualizado com sucesso!');

        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Erro ao atualizar o domínio: ' . $exception->getMessage());
        }
    }

    public function destroy(Domain $domain)
    {
        try {
            $domain->delete();
            return redirect()->route('domains.index')->with('success', 'Domínio deletado com sucesso!');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Erro ao deletar o domínio: ' . $exception->getMessage());
        }
    }
}
