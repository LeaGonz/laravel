@extends('layouts.body_layout')

@section('content')
    <h1 class="">Adicionar Álbum</h1>
    <form method="POST" action="{{ route('album.add') }}" enctype="multipart/form-data">
        @csrf

        {{-- Nome do álbum --}}
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" required>
            @error('name')
                <div class="alert alert-danger" role="alert">
                    Nome inválido!
                </div>
            @enderror
        </div>

        {{-- Foto do álbum --}}
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Foto</label>
            <input type="file" accept="image/*" class="form-control" name="photo">
            @error('photo')
                <div class="alert alert-danger" role="alert">
                    Foto inválida!
                </div>
            @enderror
        </div>

        {{-- Data de lançamento --}}
        <div class="mb-3">
            <label class="form-label">Data de Lançamento</label>
            <input type="date" name="release_at" class="form-control" required>
            @error('release_at')
                <div class="alert alert-danger" role="alert">
                    Data inválida!
                </div>
            @enderror
        </div>

        {{-- Banda --}}
        <div class="mb-3">
            <label class="form-label">Banda</label>
            <select class="form-select" name='band_id' required>
                <option selected>Selecione uma banda</option>

                @foreach ($bands as $band)
                    <option value="{{ $band->id }}">{{ $band->name }}</option>
                @endforeach

            </select>
            @error('band_id')
                <div class="alert alert-danger" role="alert">
                    Banda invalida!
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-secondary">Adicionar</button>
    </form>
@endsection
