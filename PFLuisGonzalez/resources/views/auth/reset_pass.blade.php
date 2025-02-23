@extends('layouts.body_layout')
@section('content')
    {{-- Mensagem informativa para o utilizador --}}
    @if (@session('status'))
        <div class="alert alert-success mt-3" role="alert">
            Iremos enviar um e-mail para recuperação da palavra-passe
        </div>
    @endif

    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="card p-5 shadow w-auto">

            <h4>Encontrar a tua conta</h4>

            <div>
                Insere o teu e-mail para procurares a tua conta.
            </div>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-3 mt-2">
                    <label class="form-label">Email</label>
                    <input name="email" type="email" class="form-control">
                    @error('email')
                        <div class="alert alert-danger" role="alert">
                            Email inválido!
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success w-100">Recuperar</button>
            </form>
        </div>
    </div>
@endsection
