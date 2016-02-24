<?php

namespace App\Http\Controllers;

use App\Elemento;
use App\Http\Requests;

class Elementos extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param null $id_elemento
     * @return \Illuminate\Http\Response
     */
    public function index($id_elemento = null)
    {
        if ($id_elemento == null) {
            return Elemento::orderBy('id_elemento', 'asc')->get()->toJson();
        } else {
            return $this->show($id_elemento)->toJson();
        }
    }
}