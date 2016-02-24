<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipo;
use App\Elemento;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;

class Tipos extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param null $id_elemento
     * @return \Illuminate\Http\Response
     */

    public function filtering($id)
    {
    $tipo = DB::table('tipos')->where('id_tipo', $id)->pluck('id_tipo');
    $elementos = DB::table('elementos')->where('id_tipo', $tipo)->get();
       $options = collect();
        foreach ($elementos as $elemento) {
            $options->push(['id' => $elemento->id_elemento, 'value' => $elemento->Elemento]);
        }
        return Response::json($options);

    }

}