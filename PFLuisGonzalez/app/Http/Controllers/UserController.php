<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Função que devolve a view userHome.blade.php
     * com a tabela dos utilizadores
     */
    public function userHome()
    {
        $search = request()->query("search") ? request()->query("search") : null;
        $users = $this->usersGetFromDB($search);

        return view('users.userHome', compact('users'));
    }

    /**
     * Função para procurar utilizadores com barras de pesquisa
     */
    public function usersGetFromDB($search)
    {
        $users = DB::table('users');

        if ($search) {
            $users = $users
                ->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%");
        }

        return $users->paginate(30);
    }

    /**
     * Função que devolve a view userAdd.blade.php
     */
    public function userAddShow()
    {
        return view('users.userAdd');
    }

    /**
     * Função para adicionar ou atualizar um utilizador na base de dados
     * e retorna a view userHome.blade.php
     * Atualiza: se o campo id estiver preenchido
     * Insere: se o campo id estiver vazio
     */
    public function userAdd(Request $request)
    {
        // UPDATE
        if (isset($request->id)) {
            // dd($request->all());

            // Verifica se o email é igual ao email atual
            // Se for igual, não valida o campo email
            $email = User::where('id', $request->id)->first()->email;
            if ($request->email == $email) {
                $request->validate([
                    'name' => 'required|string|min:3',
                    'user_type' => 'required|integer',
                ]);
            }
            // Se for diferente, valida o campo email
            else {
                $request->validate([
                    'name' => 'required|string|min:3',
                    'email' => 'required|email|unique:users',
                    'user_type' => 'required|integer',
                ]);
            }

            User::where('id', $request->id)
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'user_type' => $request->user_type,
                ]);

            return redirect()->route('user.home')->with('message', 'Utilizador atualizado com sucesso!');

            // INSERT
        } else {

            $request->validate([
                'name' => 'required|string|min:3',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8'
            ]);

            User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // dd($request->all());
            return redirect()->route('user.home')->with('message', 'Utilizador adicionado com sucesso!');
        }
    }

    /**
     * Função que devolve a view userView.blade.php
     * com os detalhes de um utilizador
     */
    public function userView($id)
    {
        $user = User::where('id', $id)->first();

        return view('users.userView', compact('user'));
    }

    /**
     * Função para apagar um utilizador da base de dados
     * e retorna a view userHome.blade.php
     */
    public function userDelete($id)
    {
        User::where('id', $id)->delete();

        return redirect()->route('user.home')->with('message', 'Utilizador apagado com sucesso!');
    }
}
