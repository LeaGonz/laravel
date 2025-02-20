@extends('layouts.body_layout')

@section('content')
    <h1 class="">Adicionar Banda</h1>
    <form method="POST" action="{{ route('band.add') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="name" class="form-control">
            @error('name')
                <div class="alert alert-danger" role="alert">
                    Nome inválido!
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Foto</label>
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
