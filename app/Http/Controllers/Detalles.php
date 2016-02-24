<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Detalle;
use Illuminate\Http\Request;
use App\Http\Requests;
class Detalles extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param null $id_detalle
     * @return Response
     */
    public function index($id_detalle = null) {
        if ($id_detalle == null) {
            return Detalle::orderBy('cantidad', 'asc')->get();
        } else {
            return $this->show($id_detalle);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        $detalle = new Detalle;
        $detalle->id_solicitud = $request->input('NumeroSolicitud');
        $detalle->id_elemento = $request->input('elemento');
        $detalle->id_dia = $request->input('dia');
        $detalle->cantidad = $request->input('cantidad');
        $detalle->save();
        return response()->json(['id' => $detalle->id_detalle]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $detalle = Detalle::find($id);
        return response()->json(['id_detalle' => $detalle->id_detalle, 'id' => $detalle->id_dia, 'value' => $detalle->id_solicitud]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        $detalle = Detalle::find($id);
        $detalle->id_elemento = $request->input('elemento');
        $detalle->cantidad = $request->input('cantidad');
        $detalle->save();
        return response()->json(['id' => $detalle->id_detalle]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  int $id
     * @return Response
     */
    public function destroy($id) {
        $detalle = Detalle::find($id);

        $detalle->delete();

        return response()->json(['id' => $detalle->id_detalle]);
    }
    }

