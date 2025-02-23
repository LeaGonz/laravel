@extends('layouts.body_layout')

@section('content')
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="card p-5 shadow w-auto">

            <h2 class="text-center mb-4">Criar Utilizador</h2>
            <form method="POST" action="{{ route('user.add') }}">
                @csrf

                {{-- Nome do Utilizador --}}
                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input type="text" name="name" class="form-control">
                    @error('name')
                        <div class="alert alert-danger" role="alert">
                            Nome inválido!
                        </div>
                    @enderror
                </div>

                {{-- Email do Utilizador --}}
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control">
                    @error('email')
                        <div class="alert alert-danger" role="alert">
                            Email inválido!
                        </div>
                    @enderror
                </div>

                {{-- Password do Utilizador --}}
                <div class="mb-3">
                    <label class="form-label">Palavra-passe</label>
                    <input type="password" name="password" class="form-control" placeholder="Mínimo 8 caracteres">
                    @error('password')
                        <div class="alert alert-danger" role="alert">
                            Palavra-passe inválida!
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success w-100">Registar-se</button>
            </form>
        </div>
    </div>
@endsection
