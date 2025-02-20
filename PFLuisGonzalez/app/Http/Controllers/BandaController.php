<?php

namespace App\Http\Controllers;

use App\Models\Musicband;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Storage;

class BandaController extends Controller
{
    /**
     * Função que devolve a view principal com a tabela das bandas
     */
    public function home()
    {
        $bands = $this->bandsGetFromDB();
        return view("home", compact('bands'));
    }

    /**
     * Função para obter as bandas da base de dados e devolver a view home.blade.php. Fazo contagem de álbuns por banda ao fazer join com a tabela albumsband
     */
    public function bandsGetFromDB()
    {
        $bands = Musicband::leftJoin('albumsband', 'musicbands.id', '=', 'albumsband.band_id')
            ->select('musicbands.*', DB::raw('count(albumsband.id) as albums_count'))
            ->groupBy('musicbands.id')
            ->get();
            // dd($bands);
        return $bands;
    }

    public function bandAddShow()
    {
        return view('bands.bandAdd');
    }
    /**
     * Função para adicionar ou atualizar uma banda na base de dados
     */
    public function bandAdd(Request $request)
    {
        // UPDATE
        if (isset($request->id)) {
            $request->validate([
                'name' => 'required|string|min:1',
                'photo' => 'image'
            ]);

            $photo = null;
            if ($request->hasFile('photo')) {
                $photo = Storage::putFile('bandPhotos', $request->photo);
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

    public function bandView($id){
        $band = Musicband::find($id);
        return view('bands.bandView', compact('band'));
    }
}
