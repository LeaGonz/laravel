@extends('layouts.body_layout')

@section('content')
    @if (session('message'))
        <div class="alert alert-success mt-3" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <div class="row mt-4">

        <form action=""> {{-- FALTA --}}
            <input type="text" name="search" id="" value="{{ request()->query('search') }}" autocomplete="off">
            <button type="submit" class="btn btn-success">Procurar</button>
        </form>

        <table class="table text-center table-secondary border border-dark mt-4">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Banda</th>
                    <th scope="col">Álbuns</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
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
                        <td><a class="btn btn-info" href="{{ route('band.view', $band->id) }}">Ver/Editar</a>
                        </td>
                        {{-- @auth
                            @if (Auth::user()->email == 'luis@luis.com')
                                <td><a class="btn btn-danger" href="{{ route('users.delete_user', $band->id) }}">Delete</a>
                                </td>
                            @endif
                        @endauth --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
