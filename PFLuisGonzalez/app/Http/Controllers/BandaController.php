<?php

namespace App\Http\Controllers;

use App\Models\Musicband;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Albumsband;
use Illuminate\Support\Facades\Storage;
// use Storage;

class BandaController extends Controller
{
    /*************************************BANDAS******************************************** */
    /**
     * Função que devolve a view principal com a tabela das bandas
     */
    public function home()
    {

        $search = request()->query("search") ? request()->query("search") : null;
        $bands = $this->bandsGetFromDB($search);

        return view("home", compact('bands'));
    }

    /**
     * Função para obter as bandas da base de dados e devolver a view home.blade.php.
     * Fazo contagem de álbuns por banda ao fazer join com a tabela albumsband
     */
    public function bandsGetFromDB($search)
    {
        $bands = Musicband::leftJoin('albumsbands', 'musicbands.id', '=', 'albumsbands.band_id')
            ->select('musicbands.*', DB::raw('COUNT(albumsbands.id) as albums_count'))
            ->groupBy('musicbands.id', 'musicbands.name', 'musicbands.photo', 'musicbands.created_at', 'musicbands.updated_at');

        if ($search) {
            $bands = $bands->where('musicbands.name', 'LIKE', "%{$search}%");
        }
        // dd($bands);
        return $bands->paginate(10);
    }

    /**
     * Função que retorna a view bandAdd.blade.php
     * Nesta view podemos adicionar ou atualizar uma banda
     */
    public function bandAddShow()
    {
        return view('bands.bandAdd');
    }

    /**
     * Função para adicionar ou atualizar uma banda na base de dados
     * e retorna a view home.blade.php
     * Atualiza: se o campo id estiver preenchido
     * Insere: se o campo id estiver vazio
     */
    public function bandAdd(Request $request)
    {
        // UPDATE
        // dd($request->all());
        if (isset($request->id)) {
            $request->validate([
                'name' => 'required|string|min:1',
                'photo' => 'image'
            ]);

            if ($request->hasFile('photo')) {
                $photo = Storage::putFile('bandPhotos', $request->photo);
            } else {
                $photo = Musicband::where('id', $request->id)->value('photo');
            }

            Musicband::where('id', $request->id)
                ->update([
                    'name' => $request->name,
                    'photo' => $photo,
                ]);

            return redirect()->route('home')->with('message', 'Banda atualizada com sucesso!');

            // INSERT
        } else {

            $request->validate([
                'name' => 'required|string|min:1',
                'photo' => 'image'
            ]);

            $photo = null;

            if ($request->hasFile('photo')) {
                $photo = Storage::putFile('bandPhotos', $request->photo);
            }

            Musicband::insert([
                'name' => $request->name,
                'photo' => $photo
            ]);

            return redirect()->route('home')->with('message', 'Banda adicionada com sucesso!');
        }
    }

    /**
     * Função que retorna a view bandView.blade.php
     * com os detalhes de uma banda específica quando
     * clicamos no botão "Ver" na tabela
     */
    public function bandView($id)
    {
        $band = Musicband::where('id', $id)->first();

        $search = request()->query("search") ? request()->query("search") : null;
        $albuns = $this->albumSearch($id, $search);
        // $albuns = Albumsband::where('band_id', $id)->get();

        // dd($albuns);
        return view('bands.bandView', compact('band', 'albuns'));
    }

    /**
     * Função para pesquisar álbuns de uma banda específica
     * na barrar de pesquisa da view bandView.blade.php
     */
    public function albumSearch($id, $search)
    {
        $albuns = Albumsband::where('band_id', $id);

        if ($search) {
            $albuns = $albuns->where('name', 'LIKE', "%{$search}%");
        }

        return $albuns->paginate(10);
    }

    /**
     * Função para apagar uma banda da base de dados
     * quando clicamos no botão "Apagar" na tabela
     * e retorna a view home.blade.php
     */
    public function bandDelete($id)
    {
        Albumsband::where('band_id', $id)
            ->delete();
        Musicband::where('id', $id)
            ->delete();

        return redirect()->route('home')->with('message', 'Banda apagada com sucesso!');
    }
}
