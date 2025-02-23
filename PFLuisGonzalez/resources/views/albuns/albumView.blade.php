@extends('layouts.body_layout')

@section('content')
    {{-- Formulario para atualizar o álbum --}}
    <div class="row mt-4">
        <h1 class="">Álbum "{{ $album->name }}"</h1>

        <form method="POST" action="{{ route('album.add') }}" enctype="multipart/form-data">
            @csrf
            {{-- Usaremos este input no update --}}
            <input type="hidden" name="id" value="{{ $album->id }}">

            {{-- Nome do álbum --}}
            <div class="row">
                <div class="col mb-3">
                    <label class="form-label">Nome</label>
                    <input type="text" name="name" class="form-control" value="{{ $album->name }}">
                    @error('name')
                        <div class="alert alert-danger" role="alert">
                            Nome inválido!
                        </div>
                    @enderror
                </div>
                {{-- Foto --}}
                <div class="col text-center mb-3">
                    <img style="width:150px; height:150px"
                        src="{{ $album->photo ? asset('storage/' . $album->photo) : asset('img/nophoto.jpg') }}"
                        alt="">
                </div>
            </div>

            {{-- Foto do álbum --}}
            <div class="mb-3">
                <label class="form-label">Foto</label>
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
                <input type="date" name="release_at" class="form-control" value="{{ $album->release_at }}" required>
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
                    <option value="{{ $bandId->id }}" selected>{{ $bandId->name }}</option>

                    @foreach ($bands as $band)
                        {{-- if para não mostrar a banda atual no select --}}
                        @if ($band->id != $bandId->id)
                            <option value="{{ $band->id }}">{{ $band->name }}</option>
                        @endif
                    @endforeach

                </select>
                @error('band_id')
                    <div class="alert alert-danger" role="alert">
                        Banda invalida!
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-secondary">Atualizar</button>
        </form>
    </div>
@endsection
