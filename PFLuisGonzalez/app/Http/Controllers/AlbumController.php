<?php

namespace App\Http\Controllers;

use App\Models\Musicband;
use App\Models\Albumsband;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    /*************************************ALBUNS******************************************** */
    /**
     * Função que retorna a view albumAdd.blade.php
     * Função para preencher o select com as bandas
     */
    public function albumAddShow()
    {
        $bands = Musicband::all();
        // dd($bands);

        return view('albuns.albumAdd', compact('bands'));
    }

    /**
     * Função para adicionar ou atualizar um álbum na base de dados
     * e retorna a view home.blade.php
     * Atualiza: se o campo id estiver preenchido
     * Insere: se o campo id estiver vazio
     */
    public function albumAdd(Request $request)
    {
        // UPDATE
        if (isset($request->id)) {

            $request->validate([
                'name' => 'required|string|min:1',
                'photo' => 'image',
                'release_at' => 'required|date',
                'band_id' => 'required|integer'
            ]);
            // dd($request->all());

            $photo = null;
            if ($request->hasFile('photo')) {
                $photo = Storage::putFile('albumPhotos', $request->photo);
            } else {
                $photo = Albumsband::where('id', $request->id)->value('photo');
            }

            Albumsband::where('id', $request->id)
                ->update([
                    'name' => $request->name,
                    'photo' => $photo,
                    'release_at' => $request->release_at,
                    'band_id' => $request->band_id
                ]);

            return redirect()->route('home')->with('message', 'Álbum atualizado com sucesso!');

            // INSERT
        } else {

            $request->validate([
                'name' => 'required|string|min:1',
                'photo' => 'image',
                'release_at' => 'required|date',
                'band_id' => 'required|integer'
            ]);


            $photo = null;
            if ($request->hasFile('photo')) {
                $photo = Storage::putFile('albumPhotos', $request->photo);
            }

            // dd($request->release_at);
            Albumsband::insert([
                'name' => $request->name,
                'photo' => $photo,
                'release_at' => $request->release_at,
                'band_id' => $request->band_id
            ]);

            return redirect()->route('home')->with('message', 'Álbum adicionado com sucesso!');
        }
    }

    /**
     * Função que retorna a view albumView.blade.php
     * com os detalhes de um álbum específico quando
     * clicamos no botão "Editar" na tabela
     */
    public function albumView($id)
    {
        $album = Albumsband::where('id', $id)->first();

        // Variáveis para comparar e preencher o select com as bandas
        $bands = Musicband::all();
        $bandId = Musicband::where('id', $album->band_id)->first();

        // dd($band);

        return view('albuns.albumView', compact('album', 'bands', 'bandId'));
    }

    /**
     * Função para apagar uma banda da base de dados
     * quando clicamos no botão "Apagar" na tabela
     * e retorna a view home.blade.php
     */
    public function albumDelete($id)
    {
        Albumsband::where('id', $id)
            ->delete();

        return redirect()->route('home')->with('message', 'Album apagado com sucesso!');
    }
}
