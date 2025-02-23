@extends('layouts.body_layout')
@section('content')
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="card p-5 shadow w-auto">

            <h2 class="text-center mb-4">Iniciar Sessão</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf

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
                    <input type="password" name="password" class="form-control">
                    @error('password')
                        <div class="alert alert-danger" role="alert">
                            Palavra-passe inválida!
                        </div>
                    @enderror
                </div>

                {{-- Secção de esquecer palavra-passe --}}
                <div class="mb-3">
                    <a href="{{ route('password.request') }}">Esqueceste-te da palavra-passe?</a>
                </div>

                <button type="submit" class="btn btn-success w-100">Autenticar</button>
            </form>
        </div>
    </div>
@endsection
