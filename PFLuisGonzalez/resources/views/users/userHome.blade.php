@extends('layouts.body_layout')

@section('content')
    @if (session('message'))
        <div class="alert alert-success mt-3" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <h2 class="mt-2 text-center">Utilizadores do Sistema</h2>

    <div class="row mt-4 text-end">
        <div class="col text-start">
            <h5>Bem-vindo Admin: {{ Auth::user()->name }}</h5>
        </div>
        {{-- Barra de pesquisa Utilizador --}}
        <div class="col">
            <form action="">
                <input type="text" id="search" placeholder=" Nome ou Email" name="search"
                    value="{{ request()->query('search') }}">
                <button type="submit" class="btn btn-secondary">Procurar</button>
            </form>
        </div>
    </div>

    <div class="row mt-2">

        <table class="table text-center table-secondary border border-dark mt-4">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Tipo</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($users as $user)
                    <tr class="table-dark">
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        @if ($user->user_type == 1)
                            <td>Administrador</td>
                        @else
                            <td>Utilizador</td>
                        @endif
                        <td>
                            <a class="btn btn-outline-success" href="{{ route('user.view', $user->id) }}">Ver / Editar</a>
                        </td>
                        <td>
                            <a class="btn btn-outline-danger" href="{{ route('user.delete', $user->id) }}">Apagar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
