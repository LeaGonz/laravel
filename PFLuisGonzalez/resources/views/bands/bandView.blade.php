@extends('layouts.body_layout')

@section('content')
    <h1 class="">Banda "{{ $band->name }}"</h1>
    <form method="POST" action="{{ route('band.add') }}" enctype="multipart/form-data">
        @csrf
        {{-- Usaremos para fazer o update --}}
        <input type="hidden" name="id" value="{{ $band->id }}">
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
            <div class="col text-center mb-3">
                <img style="width:80px; height:80px"
                    src="{{ $band->photo ? asset('storage/' . $band->photo) : asset('img/nophoto.jpg') }}" alt="">
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Foto</label>
            <input type="file" accept="image/*" class="form-control" name="photo" id="photo">
            @error('photo')
                <div class="alert alert-danger" role="alert">
                    Foto inválida!
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>
@endsection
