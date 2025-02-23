@extends('layouts.body_layout')

@section('content')
    @if (session('message'))
        <div class="alert alert-success mt-3" role="alert">
            {{ session('message') }}
        </div>
    @endif

    {{-- Barra de pesquisa Banda --}}
    <div class="row mt-4 text-end">

        <form action="">
            <input type="text" id="search" placeholder=" Nome da banda" name="search"
                value="{{ request()->query('search') }}">
            <button type="submit" class="btn btn-secondary">Procurar</button>
        </form>

    </div>

    <div class="row mt-2">

        <table class="table text-center table-secondary border border-dark mt-4">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Banda</th>
                    <th scope="col">Álbuns</th>
                    <th scope="col">YouTube</th>
                    <th scope="col"></th>
                    @auth
                        @if (Auth::user()->user_type == 1)
                            <th scope="col"></th>
                        @endif
                    @endauth
                </tr>
            </thead>
            <tbody>

                @foreach ($bands as $band)
                    <tr class="table-dark">
                        <th scope="row">{{ $band->id }}</th>
                        <td><img style="width:50px; height:50px"
                                src="{{ $band->photo ? asset('storage/' . $band->photo) : asset('img/nophoto.jpg') }}"
                                alt=""></td>
                        <td>{{ $band->name }}</td>
                        <td>{{ $band->albums_count }}</td>
                        <td><a class="btn btn-outline-danger" href="https://www.youtube.com/results?search_query={{$band->name}}" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                                <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z"/>
                              </svg>
                        </td>
                        <td><a class="btn btn-outline-success" href="{{ route('band.view', $band->id) }}">Ver / Editar</a>
                        </td>
                        @auth
                            {{-- Mostramos o botão de apagar apenas se o utilizador for administrador --}}
                            @if (Auth::user()->user_type == 1)
                                <td><a class="btn btn-outline-danger" href="{{ route('band.delete', $band->id) }}">Apagar</a>
                                </td>
                            @endif
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
