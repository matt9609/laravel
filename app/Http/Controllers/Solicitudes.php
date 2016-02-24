<?php

namespace App\Http\Controllers;

use App\Detalle;
use App\Solicitud;
use App\Proyecto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use View;
use Illuminate\Support\Facades\Mail;

class Solicitudes extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_solicitud = null)
    {
        if ($id_solicitud == null) {
            return Solicitud::orderBy('id_solicitud', 'asc')->get();
        } else {
            return $this->show($id_solicitud);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $solicitud = new Solicitud;
        $solicitud->id_proyecto = $request->input('selectConstruct');
        $solicitud->id_usuario = $request->user()->id;
        $solicitud->save();
        return response()->json(['id' => $solicitud->id_solicitud]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Solicitud::find($id);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id_solicitud) {
        $Solicitud = Solicitud::find($id_solicitud);
        $Solicitud->delete();

        return "Solicitud eliminada #" . $request->input('id');
    }

    public function sendEmail(Request $request, $id){
        $solicitud = Solicitud::find($id);
        $solicitudID = $solicitud->id_solicitud;
        $elementos = $solicitud->detalles()->get();
        $proyecto = $solicitud->proyecto->Proyecto;
        $options= collect();
        $nombre = null;
        $tipo = null;
        foreach($elementos as $elemento) {
            $cantidad = $elemento->cantidad;
            $nombre = $elemento->elemento->Elemento;
            $tipo = $elemento->elemento->tipos->Tipos;
            $dia = $elemento->dia->Dia;
            $options->push(['dia' => $dia,'tipo'=>$tipo, 'names'=>$nombre, 'cantidad' => $cantidad, 'usuario' => $request->user()->name, 'proyecto' => $proyecto]);
        }

        $sorted = $options->toArray();

        Mail::send('mail', array('sorted' => $sorted), function($message) {
            $message->from('us@example.com', 'Laravel');
            $message->to('foo@example.com');
            $message->cc('bar@example.com');
            Carbon::setLocale('es');
            $dt = Carbon::now('America/Bogota');
            $message->subject('Nueva Solicitud de Materiales '. $dt->toFormattedDateString());
        });

        return redirect('/');

    }
    public function misSolicitudes(Request $request)
    {
        $user = $request->user();
        $solicitudes = $user->solicitudes()->get();
        $options = collect();
        foreach ($solicitudes as $solicitud) {
            $proyecto = $solicitud->proyecto->Proyecto;
            $solicitudID = $solicitud->id_solicitud;
            $options->push(['id' => $solicitudID, 'proyecto' => $proyecto, $solicitud->created_at]);
        }

        $ordenado = $options->sortBy('id')->toArray();

        return view('mis-solicitudes', array('ordenado' => $ordenado));
    }
}
