<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Examen;
use App\Models\Subgrupoexamen;
use App\Models\Valoresexamen;
use App\Models\Unidad;
use App\Models\Solicitud;
use App\Models\SolicitudDetails;
use App\Models\PosiblesResultados;
use DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;

class ResultadosController extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';

     
    public $pacient,
    $medic,
    $process,
    
    $state,
    $solicitud_date,
    $selected_id;
     
    public $solicitud,
    $exam,
    $grupo,
    $subgrupo,
    $valores,
    $result,
    $price,
    $id_solicitud;

    public $info2,$inf, $selectesSolicitud;
    public $search, $action=1, $pagination = 8;

    public $grupos_name, $examenes_name, $subgrupo_name;
    public $paciente, $paciente_nombre, $paciente_ci, $paciente_nacimiento;
    public $num_solicitud, $fecha_solicitud, $total, $pago, $saldo_pagar;
    public $medico,$medico_nombre,$medico_especialidad;

    public $posibles_resultados;

    public $pdf;
    public function render()
    {
        $directory = storage_path('app\examenes_entregados');
        $files = \Storage::files('examenes_entregados');
        if(strlen($this->search) > 0){
            $info = Solicitud::leftjoin('pacientes as p','p.id','solicitudes.pacient')
            ->leftjoin('medicos as m','m.id','solicitudes.medic')
            ->select('solicitudes.*',DB::raw("CONCAT(p.name,' ',p.last_name) as paciente"),DB::raw("CONCAT(m.name,' ',m.last_name) as medico"))
            ->orwhere('p.name','like','%'. $this->search.'%')
            ->orwhere('p.last_name','like','%'. $this->search.'%')
            ->orwhere('m.name','like',$this->search.'%')
            ->orwhere('m.last_name','like',$this->search.'%')
            ->orwhere('solicitudes.solicitud_date','like',$this->search.'%')
            ->orwhere('solicitudes.state_pago','like',$this->search.'%')
            ->orwhere('solicitudes.state_result','like',$this->search.'%')
            ->orwhere('solicitudes.id','like',$this->search.'%')
            ->orderBy('solicitudes.id','DESC')
            ->paginate($this->pagination);
            return view('livewire.resultados.resultados-controller',[
                'info'=>$info,
                'archivos'=> $files

            ]);
        }
        $info = Solicitud::leftjoin('pacientes as p','p.id','solicitudes.pacient')
            ->leftjoin('medicos as m','m.id','solicitudes.medic')
            ->select('solicitudes.*',DB::raw("CONCAT(p.name,' ',p.last_name) as paciente"),DB::raw("CONCAT(m.name,' ',m.last_name) as medico"))
            ->orderBy('solicitudes.id', 'DESC')
            ->paginate($this->pagination);
            return view('livewire.resultados.resultados-controller',[
                'info'=>$info,
                'archivos'=> $files
            ]);
    }
    public function change_state_pago($id,$descuento)
    {
        $state = Solicitud::where('id',$id)->get();
        $record = Solicitud::where('id',$id);
        foreach ($state as $i) {
            $estado = $i->state_pago;
            $total = $i->total;
            $pago = $i->pago;
        } 
        if ($estado == "DEBE") {
            $record->update([
                'state_pago'=>'CANCELADO',
                'pago' => $total-$descuento,
                'discount' => $descuento,
                ]);
            $this->emit('msgok', 'Cuenta saldada con exito');
        }
    }
    public function change_state_result($id)
    {
        $state = Solicitud::where('id',$id)->get();
        $record = Solicitud::where('id',$id);
        foreach ($state as $i) {
            $estado = $i->state_result;
            
        } 
        if ($estado == "RECEPCIONADO") {
            $record->update([
                'state_result'=>'TRANSCRITO',
                ]);
            $this->emit('msgok', 'Estado actualizado a SOLICITUD TRANSCRITA');
        }
        if ($estado == "TRANSCRITO") {
            $record->update([
                'state_result'=>'ENTREGADO',
                ]);
            $this->emit('msgok', 'Estado actualizado a EXÁMEN ENTREGADO');
        }
        if ($estado == "ENTREGADO") {
            $this->emit('msg-warning', 'EL EXÁMEN YA FUE ENTREGADO');
        }
    }
    public function updatingSearch()
    {
        $this->gotoPage(1);
    }
    public function doAction($action)
    {
        $this->action = $action;
    }
    public function resetInput()
    {
        
    }
    public function edit($id)
    {
        $this->posibles_resultados = PosiblesResultados::select('description')->get();
        $this->selectesSolicitud = $id;
        //vista editar resultados
        $this->info2 = SolicitudDetails::leftjoin('examenes as e','e.id','solicitud_details.exam')
        ->leftjoin('grupos as g','g.id','solicitud_details.grupo')
        ->leftjoin('subgrupoexamenes as sge','sge.id','solicitud_details.subgrupo')
        ->leftjoin('valoresexamenes as v','v.id','solicitud_details.valores')
        ->leftjoin('unidades as u','u.id','v.unidad')
        ->select('solicitud_details.id','solicitud_details.solicitud','solicitud_details.result','solicitud_details.observation','g.name as grupo','g.id as g_id','e.id as exam_id','e.name as examen','e.price_normal as precio','sge.name as subgrupo','v.name as valores','v.rango_normal as rango','u.unit as unidad')
        ->where('solicitud',$id)
        ->orderBy('exam_id','asc')->get();
       
        $this->inf = SolicitudDetails::leftjoin('examenes as e','e.id','solicitud_details.exam')
        ->select('e.id as exam_id','e.name')
        ->where('solicitud',$id)->groupBy('exam_id','e.name')->get();

       
        $this->grupos_name = SolicitudDetails::leftjoin('grupos as g','g.id','solicitud_details.grupo')
                                                    ->select('g.name as grupo')
                                                    ->where('solicitud_details.solicitud',$id)
                                                    ->groupBy('grupo')
                                                    ->get();
    
        $this->examenes_name = SolicitudDetails::leftjoin('examenes as e','e.id','solicitud_details.exam')
                                                    ->select('e.name as examen')
                                                    ->where('solicitud_details.solicitud',$id)
                                                    ->groupBy('examen')
                                                    ->get();

        $this->subgrupo_name = SolicitudDetails::leftjoin('subgrupoexamenes as sge','sge.id','solicitud_details.subgrupo')
                                                    ->select('sge.name as subgrupo')
                                                    ->where('solicitud_details.solicitud',$id)
                                                    ->groupBy('subgrupo')
                                                    ->get();


        $this->paciente = Solicitud::leftjoin('pacientes as p','p.id','solicitudes.pacient')
                                    ->select('*')
                                    ->where('solicitudes.id',$id)
                                    ->get();
        foreach ($this->paciente as $p) {
            $this->paciente_nombre = $p->name.' '.$p->last_name;
            $this->paciente_ci = $p->nro_ci;
            $this->paciente_nacimiento = Carbon::parse($p->date_nac)->age;
        }

        $this->solicitud =Solicitud::find($id)->get();
        foreach ($this->solicitud as $s) {
            $this->num_solicitud = $s->id;
            $this->fecha_solicitud = $s->created_at;
            $this->total = $s->total.' Bs.';
            $this->pago = $s->pago.' Bs.';
            $this->saldo_pagar = $s->total-$s->pago.'.00 Bs.';

        }  
        
        $this->medico = Solicitud::leftjoin('medicos as m','m.id','solicitudes.medic')
                                    ->select('*')
                                    ->where('solicitudes.id',$id)
                                    ->get();
        foreach ($this->medico as $m) {
            $this->medico_nombre = $m->name.' '.$m->last_name;
            $this->medico_especialidad = $m->speciality;
        }
        
        $this->action = 2;
        
    }
    
    public function AsignarResultados($resultadosList, $obslist)
	{	  	
        //$this->info2;
        try {
            //contamos los examenes de la lista
            $numero_examenes=count($resultadosList);
            //iniciamos un contador
            $count = 0;  
             
            //mientras el contador sea menor al nuemero de examenes se sige ejecutando la consulta
            while($count<$numero_examenes){
            //sacamos el id que viene en el array
            $id = $resultadosList[$count][0];
            //bucamos la solicitud
            $solicitudDetalle = SolicitudDetails::find($id);
            //actualizamos el resultado
            $solicitudDetalle-> update([
                'result' =>$resultadosList[$count][1],
                'observation' =>$obslist[$count],
            ]);
            //aumentamos el contador
            $count++;
            //emitimos un mensaje de 
        }
            //abucamos la solicitud
            $solicitud = Solicitud::find($this->selectesSolicitud );
            //actualizamos el estado resultado
            $solicitud-> update([
                'state_result'=>"TRANSCRITO",
            ]);
        
        $this->emit('msgok', 'Resultados guardados con Exito');
        $this->action=1;
        }catch (\Exception $e) {
            dd($e);
      }
    }
    public function Pdf($id)
    {
        $info = Solicitud::leftjoin('solicitud_details as sd','sd.solicitud','solicitudes.id' )
                            ->leftjoin('pacientes as p','p.id','solicitudes.pacient')
                            ->leftjoin('medicos as m','m.id','solicitudes.medic')
                            ->select('solicitudes.*',
                                        DB::raw("CONCAT(p.name,' ',p.last_name) as paciente"),
                                        DB::raw("CONCAT(m.name,' ',m.last_name) as medico"),
                                        DB::raw("solicitudes.total-(solicitudes.pago+solicitudes.discount) as saldo_pagar"),
                                        'p.date_nac',
                                        'p.nro_ci',
                                        'm.speciality',
                                        'solicitudes.created_at as fecha_solicitud',
                                        'solicitudes.id as num_orden'
                                    )
                            ->where('solicitudes.id',$id)
                            ->get();
        $total = Solicitud::select('total')->where('id',$id)->get();
     
        $examenes = SolicitudDetails::leftjoin('examenes as e','e.id','solicitud_details.exam')
                            ->select('e.name as examen','solicitud_details.price',
                                DB::raw("SUM(price) as total"),
                            )
                            ->where('solicitud',$id)
                            ->groupBy('examen','price')->get();
                            
       $pdf = PDF::loadView('livewire.resultados.pdf',
       ['id'=>$id,
        'total'=>$total,
        'examenes'=>$examenes,
        'info'=>$info,
       ])->output();
       return response()->streamDownload(
          fn() => print($pdf),
          'Solicitud-'.$id.'-'.Carbon::now()->format('Y-m-d').'.pdf'
       );

    }
    public function ResultadosPdf($id)
    {
        $info = Solicitud::leftjoin('pacientes as p','p.id','solicitudes.pacient')
                            ->leftjoin('medicos as m','m.id','solicitudes.medic')
                            ->select('solicitudes.*',
                                        DB::raw("CONCAT(p.name,' ',p.last_name) as paciente"),
                                        DB::raw("CONCAT(m.name,' ',m.last_name) as medico"),
                                        'p.date_nac',
                                        'p.nro_ci',
                                        'p.sex',
                                        'm.speciality',
                                        'solicitudes.created_at as fecha_solicitud',
                                        'solicitudes.id as num_orden'
                                    )
                            ->where('solicitudes.id',$id)
                            ->get();
        //examenes
        $examenes = SolicitudDetails::leftjoin('grupos as g','g.id','solicitud_details.grupo')
                            ->leftjoin('examenes as e','e.id','solicitud_details.exam')
                            ->leftjoin('subgrupoexamenes as sge','sge.id','solicitud_details.subgrupo')
                            ->leftjoin('valoresexamenes as ve','ve.id','solicitud_details.valores')
                            ->leftjoin('unidades as u','u.id','ve.unidad')
                            ->select('g.name as grupo','e.name as examen','sge.name as subgrupo','ve.name as valores','solicitud_details.result','u.unit as unidad','ve.rango_normal as rango')
                            ->where('solicitud',$id)
                            ->groupBy('grupo','e.name','subgrupo','valores','solicitud_details.result','unidad','rango')->get();
       $pdf = PDF::loadView('livewire.resultados.resultados',
       ['id'=>$id,
        'examenes'=>$examenes,
        'info'=>$info,
        'origen' => 'Resultado de exámenes emitido por personal del laboratorio clínico "San Gabriel"'
       ])->output();
       foreach ($info as $i) {
           $paciente = $i->paciente;
        }
        if (\Storage::exists('examenes_entregados/solicitud '.$id.' fecha '.Carbon::now()->format('Y-m-d').'.pdf')) {
            //guardar el roporte
            \Storage::put('examenes_entregados/solicitud '.$id.' fecha '.Carbon::now()->format('Y-m-d').' copia.pdf', $pdf);
        }else{
            \Storage::put('examenes_entregados/solicitud '.$id.' fecha '.Carbon::now()->format('Y-m-d').'.pdf', $pdf);
        }
        $pdf = preg_replace("/>s+</", "><", $pdf);
        return response()->streamDownload(
            fn() => print($pdf),
            'Resultados-'.$id.'-'.Carbon::now()->format('Y-m-d').'.pdf'
        );
    }
    public function descargar($name)
    {       
        return response()->download(storage_path('app/'.$name));
    }
    public function eliminar($name)
    {    
        if ($name != '') {
            \Storage::delete($name);
            return $this->emit('msgok', 'Reporte eliminado con Exito');
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }
    protected $listeners = [
        'change_state_pago' => 'change_state_pago',
        'change_state_result' => 'change_state_result',
        'AsignarResultados'    => 'AsignarResultados',
        'Pdf'    => 'Pdf',
        'ResultadosPdf'=>'ResultadosPdf',
        'descargar' => 'descargar',
        'eliminar' => 'eliminar',
    ];
}
