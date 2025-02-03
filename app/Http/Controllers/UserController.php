<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::query()
            ->when(request('search'), function($query) {
                return $query
                        ->where('name', 'like', '%'.request('search').'%')
                        ->orWhere('email', 'like', '%'.request('search').'%');
            })
            ->orderBy(request('sort_by', 'name'), request('sort_dir', 'asc'))
            ->paginate(10);
        //$users = User::orderBy('name', 'asc')->paginate(10);
        return view('users', compact('users'));
    }

    public function store(Request $request, User $user)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:4',
            ]);

            $user->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');

        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Erro ao criar usuário: ' . $exception->getMessage());
        }
    }

    public function update(Request $request, User $user)
    {
        try {

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:4',
            ]);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password ? bcrypt($request->password) : $user->password,
            ]);

            return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');

        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Erro ao atualizar usuário: ' . $exception->getMessage());
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'Usuário deletado com sucesso!');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Erro ao deletar o usuário: ' . $exception->getMessage());
        }
    }
}