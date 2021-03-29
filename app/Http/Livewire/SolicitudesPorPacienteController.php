<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Paciente;
use App\Models\Solicitud;
use App\Models\SolicitudDetails;
use Carbon\Carbon;
use DB;
use Barryvdh\DomPDF\Facade as PDF;

class SolicitudesPorPacienteController extends Component
{
	public $fecha_ini, $fecha_fin, $pacienteselected, $solicitudes=[],$info=[];
    public $total;
    public $nombre, $edad = 0, $ci, $activo;
    public $vista = 0;
    public $detalleSolicitud;
    public function render()
    {
        
        $pacientes = Paciente::get();

        return view('livewire.reportes.solicitudes-por-paciente',[
			'pacientes' => $pacientes,
		]);
    }

    public function Consulta()
	{
        //generamos la vista 1 si solo son las solicitudes
        $this->vista = 1;
        //formeamos las fechas de inicio y fin
		$fi = Carbon::parse($this->fecha_ini)->format('Y-m-d').' 00:00:00';
		$ff = Carbon::parse($this->fecha_fin)->format('Y-m-d').' 23:59:59';

        if($this->fecha_ini > $this->fecha_fin)
    	{
    		$this->emit('msg-warning', 'Falta rango de fechas o rango de fechas no válido, por favor revise las fechas ingresadas.');
        }

        //si no se selecciono ningin paciente emitimos un mensaje de error;
			
            //buscamos al paciente
            $paciente = Paciente::where('id',$this->pacienteselected)->get();
            //iteramos para asignar a las variables declaradas
            foreach ($paciente as $p) {
                $this->nombre = $p->name.' '.$p->last_name;
                $this->ci = $p->nro_ci;
                $this->edad = Carbon::parse($p->date_nac)->age;
            }
            //buscamos las solicitudes del paciente en dichas fechas
            $this->solicitudes = Solicitud::where('pacient',$this->pacienteselected)->whereBetween('created_at',[$fi,$ff])->get();
            //Sacamos el total de ingresos por pacient
            $this->total = Solicitud::where('pacient',$this->pacienteselected)->whereBetween('created_at',[$fi,$ff])->sum('pago');
            
		
    }
    
    public function Detalle()
    {
        //generamos la vista 2 si son las solicitudes mas su detalle
        $this->vista = 2;
        //formeamos las fechas de inicio y fin
        $fi = Carbon::parse($this->fecha_ini)->format('Y-m-d').' 00:00:00';
        $ff = Carbon::parse($this->fecha_fin)->format('Y-m-d').' 23:59:59';
        //si no se selecciono ningin paciente emitimos un mensaje de error;
        if($this->pacienteselected == 0)
		{
            $this->emit('msg-error', 'Seleccione un paciente');
        }else {
            //buscamos al paciente
            $paciente = Paciente::where('id',$this->pacienteselected)->get();
            //iteramos para asignar a las variables declaradas
            foreach ($paciente as $p) {
                $this->nombre = $p->name.' '.$p->last_name;
                $this->ci = $p->nro_ci;
                $this->edad = Carbon::parse($p->date_nac)->age;
            }	
            //buscamos las solicitudes del paciente en dichas fechas
            $this->solicitudes = Solicitud::where('pacient',$this->pacienteselected)->whereBetween('created_at',[$fi,$ff])->get();
            //Sacamos el total de ingresos por pacient
            $this->total = Solicitud::where('pacient',$this->pacienteselected)->whereBetween('created_at',[$fi,$ff])->sum('pago');
            //sacamos la solicitud y su detalle agrupando por id solicitud, nombre de examen, precio
            $this->detalleSolicitud = Solicitud::with(["solicitud_details" => function($q){
                $q->leftjoin('examenes','examenes.id','solicitud_details.exam');
                $q->select('solicitud_details.solicitud','examenes.name','solicitud_details.price');
                $q->groupBy('solicitud_details.solicitud','examenes.name','solicitud_details.price');
            }])->where('pacient',$this->pacienteselected)
                ->whereBetween('solicitudes.created_at',[$fi,$ff])
                ->get();
            
        }
    }
    public function PDF_Normal()
    {
        $fi = Carbon::parse($this->fecha_ini)->format('Y-m-d').' 00:00:00';
		$ff = Carbon::parse($this->fecha_fin)->format('Y-m-d').' 23:59:59';
            $paciente = Paciente::where('id',$this->pacienteselected)->get();
            foreach ($paciente as $p) {
                $this->nombre = $p->name.' '.$p->last_name;
                $this->ci = $p->nro_ci;
                $this->edad = Carbon::parse($p->date_nac)->age;
            }
            $this->solicitudes = Solicitud::leftjoin('medicos as m','m.id','solicitudes.medic')
                    ->select('solicitudes.id as id_sol','solicitudes.*','m.name as mname','m.last_name as mlast_name')
                    ->where('pacient',$this->pacienteselected)->whereBetween('solicitudes.created_at',[$fi,$ff])->get();
            $this->total = Solicitud::where('pacient',$this->pacienteselected)->whereBetween('created_at',[$fi,$ff])->sum('pago');
       
        
        $pdf = PDF::loadView('livewire.reportes.pdfsolicitudesporpaciente',
        [ 
            'fi'=>$fi, 
            'ff'=>$ff,
            'nombre'=>$this->nombre,
            'ci'=>$this->ci,
            'edad'=>$this->edad,
            'info' => $this->solicitudes,
            'sumaTotal' => $this->total
        ])->output();
        return response()->streamDownload(
           fn() => print($pdf),
           'Reporte-'.$this->nombre.Carbon::now()->format('Y-m-d').'.pdf'
        );
    }
    public function PDF_Detallado()
    {
  
         
        $fi = Carbon::parse($this->fecha_ini)->format('Y-m-d').' 00:00:00';
        $ff = Carbon::parse($this->fecha_fin)->format('Y-m-d').' 23:59:59';
       
            $paciente = Paciente::where('id',$this->pacienteselected)->get();
            foreach ($paciente as $p) {
                $this->nombre = $p->name.' '.$p->last_name;
                $this->ci = $p->nro_ci;
                $this->edad = Carbon::parse($p->date_nac)->age;
            }	
            $this->solicitudes = Solicitud::where('pacient',$this->pacienteselected)->whereBetween('created_at',[$fi,$ff])->get();
            $this->total = Solicitud::where('pacient',$this->pacienteselected)->whereBetween('created_at',[$fi,$ff])->sum('pago');
            $this->detalleSolicitud = Solicitud::with(["solicitud_details" => function($q){
                $q->leftjoin('examenes','examenes.id','solicitud_details.exam');
                $q->select('solicitud_details.solicitud','examenes.name','solicitud_details.price');
                $q->groupBy('solicitud_details.solicitud','examenes.name','solicitud_details.price');
            }])->where('pacient',$this->pacienteselected)
                ->whereBetween('solicitudes.created_at',[$fi,$ff])
                ->get();
            
        $pdf = PDF::loadView('livewire.reportes.pdfsolicitudesporpacientedetallado',
        [ 
            'fi'=>$fi, 
            'ff'=>$ff,
            'nombre'=>$this->nombre,
            'ci'=>$this->ci,
            'edad'=>$this->edad,
            'info' => $this->solicitudes,
            'detalleSolicitud' => $this->detalleSolicitud,
            'sumaTotal' => $this->total

        ])->output();
        return response()->streamDownload(
            fn() => print($pdf),
            'ReporteDetallado-'.$this->nombre.Carbon::now()->format('Y-m-d').'.pdf'
        );
    }

    protected $listeners = [
        'PDF_Normal'    => 'PDF_Normal',
        'PDF_Detallado'    => 'PDF_Detallado',
    ];
}
