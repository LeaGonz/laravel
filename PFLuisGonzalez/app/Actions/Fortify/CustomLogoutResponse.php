<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LogoutResponse;
use Illuminate\Http\Request;

class CustomLogoutResponse implements LogoutResponse
{
    public function toResponse($request)
    {
        return redirect()->route('home')->with('message', 'Sessão terminada com sucesso!');
    }
}
