@extends('layouts.body_layout')

@section('content')
    {{-- Formulario para atualizar um utilizador --}}
    <div class="row mt-4">
        <h1 class="mb-4">Utilizador "{{ $user->name }}"</h1>

        <form method="POST" action="{{ route('user.add') }}">
            @csrf

            {{-- Usaremos este input no update --}}
            <input type="hidden" name="id" value="{{ $user->id }}">

            {{-- Nome do Utilizador --}}
            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                @error('name')
                    <div class="alert alert-danger" role="alert">
                        Nome inválido!
                    </div>
                @enderror
            </div>

            {{-- Email do Utilizador --}}
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                @error('email')
                    <div class="alert alert-danger" role="alert">
                        Email inválido!
                    </div>
                @enderror
            </div>

            {{-- Tipo de Utilizador --}}
            <div class="mb-3">
                <label class="form-label">Tipo de Utilizador</label>
                <select name="user_type" class="form-select" required>
                    <option value="{{ $user->user_type }}" selected>
                        @if ($user->user_type == 1)
                            Administrador
                        @else
                            Utilizador
                        @endif
                    </option>
                    @if ($user->user_type == 1)
                        <option value="2">Utilizador</option>
                    @else
                        <option value="1">Administrador</option>
                    @endif
                </select>
            </div>

            <button type="submit" class="btn btn-success">Atualizar</button>
        </form>
    </div>
@endsection
