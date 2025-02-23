@extends('layouts.body_layout')
@section('content')
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="card p-5 shadow w-auto">
            <h4>Mudar Palavra-passe</h4>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <div class="mb-3">
                    <labelclass="form-label">Email</labelclass=>
                    <input name="email" value="{{ request()->email }}" type="email" class="form-control">
                    @error('email')
                        <div class="alert alert-danger" role="alert">
                            Email inválido!
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Palavra-passe</label>
                    <input name="password" type="password" class="form-control">
                    @error('password')
                        <div class="alert alert-danger" role="alert">
                            Palavra-passe inválida!
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirmar Palavra-passe</label>
                    <input name="password_confirmation" type="password" class="form-control">
                    @error('password_confirmation')
                    <div class="alert alert-danger" role="alert">
                        Palavra-passe inválida!
                    </div>
                @enderror
                </div>
                <input type="hidden" name="token" value="{{ request()->token }}" id="">
                <button type="submit" class="btn btn-success w-100">Mudar</button>
            </form>
        </div>
    </div>
@endsection
