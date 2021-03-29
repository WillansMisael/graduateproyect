<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Carbon\Carbon;
class CitasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:citas_crear')->only(['create','store']);
        $this->middleware('can:citas_editar')->only(['edit','update']);
        $this->middleware('can:citas_eliminar')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $citas_usuario = Cita::where('user',auth()->user()->id)->get()->pluck('user')->first();
        //dd($citas_usuario);
        return view('admin.citas.index', compact('citas_usuario'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
         
        try {
            //cambiar por paciente
        $paciente = Paciente::where('user',auth()->user()->id)->get();
        foreach ($paciente as $p) {
            $nombre_completo = $p->name.' '.$p->last_name;
            $ci = $p->nro_ci;
        }
        $datosCita = request()->only(['color','textColor','start',]);
        
       
        $cita = new Cita;
        $cita->title = "Reservacion de cita - ".$ci; 
        $cita->description = "Reservacion de cita para la realizacion de examenes clinicos del paciente: ".$nombre_completo;
        $cita->color = $request->color;
        $cita->textcolor = $request->textColor;
        $end = Carbon::create($request->start);
        $cita->end = $end->addSeconds(610);
        $cita->start = $request->start;
        $cita->state = "SINCONFIRMAR";
        $cita->user = auth()->user()->id;
        $cita->save();
        
        print_r($datosCita);
            //code...
        } catch (\Exception $e) {
            dd($e);
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $citas = Cita::where('state','CONFIRMADO')->get()->toJson();
        
        return $citas;
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosCita = request()->only(['title','description','color','textColor','start','end']);

        $respuesta = Cita::where('id',$id)->update($datosCita);
        Cita::where('id',$id)->update(['state'=>"SINCONFIRMAR"]);
        
        return response()->json($respuesta);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cita::destroy($id);

        return response()->json($id);
    }
}
