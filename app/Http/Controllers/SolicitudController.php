<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\Paciente;
use App\Models\Medico;
use App\Models\Examen;
use Illuminate\Http\Request;
use App\Http\Requests\Solicitud\StoreRequest;
use App\Http\Requests\Solicitud\UpdateRequest;
use App\Models\SolicitudDetails;
use App\Models\Subgrupoexamen;
use App\Models\Valoresexamen;
use App\Models\Unidad;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;
class SolicitudController extends Controller
{
    


    
    public function create()
    {
        $pacientes = Paciente::where('state', 'Activo')->get();
        $medicos = Medico::where('state', 'Activo')->get();
        $examenes = Examen::where('state', 'Activo')->get();
        return view('admin.solicitud.create', compact('pacientes','examenes','medicos'));
    }
    public function store(StoreRequest $request)
    {
         
        //iniciamos la transaccion
        try {
             
            // iniciamos una nueva solicitud
            if ($request->efectivo_pago == $request->total_pagar ) {
                $estado = "CANCELADO";
            }else {
                $estado = "DEBE";
            }
            $solicitud = new Solicitud;
            $solicitud->pacient = $request->paciente_id;
            $solicitud->medic = $request->medico_id;
            if ($request->normal!=null) {
                $solicitud->attention = 'NORMAL';
            }
            if ($request->emergencia!=null) {
                $solicitud->attention ='EMERGENCIA';
            }
            $solicitud->total = $request->total_pagar;
            $solicitud->pago = $request->efectivo_pago;
            $solicitud->state_pago = $estado;
            $solicitud->state_result = 'RECEPCIONADO';
            $solicitud->solicitud_date = Carbon::now('America/La_Paz');
            $solicitud->save();
            //recuperamos los Id de los examenes desde blade
            $idexamen=$request->get('idexamen');
            //recuperamos el precio
            $precio=$request->price_normal;
            //contamos cuantos examens seleccionamos
            $data = count($idexamen);
            //inicializamos el contador
            $cont = 0;
           //mientras el contador sea menor al numero de examenes seleccionados ejecutamos lo que sigue.
            while($cont<$data){
                //sacamos los grupos de los examenes segun el id del examen que seleccionamos
                $grupo = Examen::where('id',$idexamen[$cont])->get();
                 
                foreach ($grupo as $i) {$grupoid = $i->grupo;}
                //sacamos los subgrupos de los examenes segun el id del examen que seleccionamos
                $subgrupo = Subgrupoexamen::where('examen',$idexamen[$cont])->get();
              
                //sacamos solo el ID del subgrupo
                foreach ($subgrupo as $sg) {

                    //buscamos los valores segun el subgrupo y examen
                    $valor = Valoresexamen::where('subgrupoexamen',$sg->id)->get();
                    //iteramos segun los valoresexamen que se encuantren dentro de los examenes seleccionados
                    foreach ($valor as $v) {
                        //iniciamos una nueva solicitudDetalle segun los datos generados.
                        $detalle = new SolicitudDetails;
                        $detalle->solicitud=$solicitud->id;
                        $detalle->exam=$idexamen[$cont];
                        $detalle->price=$precio[$cont];
                        $detalle->grupo=$grupoid;
                        $detalle->subgrupo = $sg->id;
                        $detalle->valores = $v->id;
                        $detalle->save();
                        \Session::flash('flash_message','La solicitud fue creada con éxito');
                }
            }
                $cont = $cont+1;
            }
            

           
        } catch (\Exception $e) {
           dd($e);
        }
        return back();
    }
    
}
