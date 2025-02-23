@extends('layouts.body_layout')

@section('content')
    {{-- Formulario para atualizar a banda --}}
    <div class="row mt-4">
        <h1 class="">Banda "{{ $band->name }}"</h1>

        <form method="POST" action="{{ route('band.add') }}" enctype="multipart/form-data">
            @csrf
            {{-- Usaremos este input no update --}}
            <input type="hidden" name="id" value="{{ $band->id }}">

            {{-- Nome da Banda --}}
            <div class="row">
                <div class="col mb-3">
                    <label class="form-label">Nome</label>
                    <input type="text" name="name" class="form-control" value="{{ $band->name }}">
                    @error('name')
                        <div class="alert alert-danger" role="alert">
                            Nome inválido!
                        </div>
                    @enderror
                </div>

                {{-- Foto --}}
                <div class="col text-center mb-3">
                    <img style="width:80px; height:80px"
                        src="{{ $band->photo ? asset('storage/' . $band->photo) : asset('img/nophoto.jpg') }}"
                        alt="">
                </div>
            </div>
            @auth
                {{-- Campo para atualizar a foto --}}
                <div class="mb-3">
                    <label class="form-label">Foto</label>
                    <input type="file" accept="image/*" class="form-control" name="photo">
                    @error('photo')
                        <div class="alert alert-danger" role="alert">
                            Foto inválida!
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-secondary">Atualizar</button>
            @endauth
        </form>
    </div>

    {{-- Barra de pesquisa Álbum --}}
    <div class="row mt-4 text-end">

        <form action="">
            <input type="text" id="search" placeholder=" Nome do álbum" name="search"
                value="{{ request()->query('search') }}">
            <button type="submit" class="btn btn-secondary">Procurar</button>
        </form>

    </div>
    {{-- Tabela dos álbuns --}}
    <div class="row">
        <table class="table text-center table-secondary border border-dark mt-4">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Álbum</th>
                    <th scope="col">Data de Lançamento</th>
                    @auth
                        <th scope="col"></th>
                        @if (Auth::user()->user_type == 1)
                            <th scope="col"></th>
                        @endif
                    @endauth
                </tr>
            </thead>

            <tbody>

                @foreach ($albuns as $album)
                    <tr class="table-dark">
                        <th scope="row">{{ $album->id }}</th>
                        <td><img style="width:50px; height:50px"
                                src="{{ $album->photo ? asset('storage/' . $album->photo) : asset('img/nophoto.jpg') }}"
                                alt=""></td>
                        <td>{{ $album->name }}</td>
                        <td>{{ $album->release_at }}</td>
                        @auth
                            <td><a class="btn btn-outline-success" href="{{ route('album.view', $album->id) }}">Editar</a>
                            </td>
                            {{-- Mostramos o botão de apagar apenas se o utilizador for administrador --}}
                            @if (Auth::user()->user_type == 1)
                                <td><a class="btn btn-outline-danger" href="{{ route('album.delete', $album->id) }}">Apagar</a>
                                </td>
                            @endif
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
