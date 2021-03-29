<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Paciente;
use App\Models\Solicitud;
use App\Models\SolicitudDetails;
use Carbon\Carbon;
use DB;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExamsExport;
use Spatie\Backup\Helpers\Format;

class ReportePorExamenesController extends Component
{
    public $fecha_ini, $fecha_fin;
    public $total;
    public $vista = 0;
    public $detalleSolicitud=[];
    public function render()
    {
        $fi = Carbon::parse($this->fecha_ini)->format('Y-m-d').' 00:00:00';
		$ff = Carbon::parse($this->fecha_fin)->format('Y-m-d').' 23:59:59';
        if($this->fecha_ini !== '')
    	{
    		$fi = Carbon::parse($this->fecha_ini)->format('Y-m-d').' 00:00:00';
    		$ff = Carbon::parse($this->fecha_fin)->format('Y-m-d').' 23:59:59';
        }
           
            //buscamos las solicitudes del paciente en dichas fechas
            $examenes = SolicitudDetails::select('examen','price','attention',DB::raw('COUNT(price) as cantidad'))->from(function ($q)
            {
                $q->select('solicitud','solicitud_details.grupo','e.name as examen','s.attention','price',DB::raw('s.created_at as fc'));
                $q->from('solicitud_details');
                $q->join('examenes as e','e.id','solicitud_details.exam');
                $q->join('solicitudes as s','s.id','solicitud_details.solicitud');
                $q->where('s.state_pago','CANCELADO');
                //$q->whereBetween('solicitud_details.created_at',[$fi,$ff]);
                $q->groupBy('solicitud','solicitud_details.grupo','examen','price','fc');
            })->whereBetween('fc',[$fi,$ff])
            ->groupBy('examen','price','attention')->get();
            //antiguo
            $directory = storage_path('app\reportes_por_examen');
            $files = \Storage::files('reportes_por_examen');

            $examen = SolicitudDetails::join('examenes as e','e.id','solicitud_details.exam')
                            ->select('solicitud','solicitud_details.grupo','e.name as examen','solicitud_details.subgrupo','price',DB::raw('COUNT(price) as cantidad'))
                            ->whereBetween('solicitud_details.created_at',[$fi,$ff])
                            ->groupBy('solicitud','solicitud_details.grupo','examen','solicitud_details.subgrupo','price')->get();
            return view('livewire.reportes.reporte-por-examenes',[
            'examenes'=>$examenes,
            'archivos'=> $files
            ]);
            
    }

    public function Cantidad()
    {
        $this->vista=0;
        if($this->fecha_ini > $this->fecha_fin)
    	{
    		$this->emit('msg-warning', 'Falta rango de fechas o rango de fechas no válido, por favor revise las fechas ingresadas.');
        } 
        
    }
    public function Ingresos()
	{
        if($this->fecha_ini > $this->fecha_fin)
    	{
    		$this->emit('msg-warning', 'Falta rango de fechas o rango de fechas no válido, por favor revise las fechas ingresadas.');
        } 
        else if( $this->fecha_ini == 0 || $this->fecha_fin == 0)
		{
            $this->emit('msg-warning', 'Seleccione fechas');
		}
		else {	
            $fi = Carbon::parse($this->fecha_ini)->format('Y-m-d').' 00:00:00';
            $ff = Carbon::parse($this->fecha_fin)->format('Y-m-d').' 23:59:59';
            $this->vista = 1;
            $this->total = Solicitud::whereBetween('solicitudes.created_at',[$fi,$ff])->sum('pago');
     
            if(($this->total == 0)){
                $this->emit('msg-warning', 'No se genero ingresos en las fechas seleccionadas');
            }else{
                $this->emit('msgok', 'Reporte generado');
            }
        }
    }

    public function PDF_EXAMEN()
    {
        $fi = Carbon::parse($this->fecha_ini)->format('Y-m-d').' 00:00:00';
		$ff = Carbon::parse($this->fecha_fin)->format('Y-m-d').' 23:59:59';
        if($this->fecha_ini !== '')
    	{
    		$fi = Carbon::parse($this->fecha_ini)->format('Y-m-d').' 00:00:00';
    		$ff = Carbon::parse($this->fecha_fin)->format('Y-m-d').' 23:59:59';
        }
            
            //buscamos las solicitudes del paciente en dichas fechas
            $examenes = SolicitudDetails::select('examen','price','attention',DB::raw('COUNT(examen) as cantidad'))->from(function ($q)
            {
                $q->select('solicitud','solicitud_details.grupo','e.name as examen','s.attention','price',DB::raw('s.created_at as fc'));
                $q->from('solicitud_details');
                $q->join('examenes as e','e.id','solicitud_details.exam');
                $q->join('solicitudes as s','s.id','solicitud_details.solicitud');
                $q->where('s.state_pago','CANCELADO');
            
                $q->groupBy('solicitud','solicitud_details.grupo','examen','price','fc');
            })->whereBetween('fc',[$fi,$ff])
            ->groupBy('examen','price','attention')
            ->orderBy('examen','asc')->get();
            //antiguo
            $examen = SolicitudDetails::join('examenes as e','e.id','solicitud_details.exam')
                            ->select('solicitud','solicitud_details.grupo','e.name as examen','solicitud_details.subgrupo','price',DB::raw('COUNT(price) as cantidad'))
                            ->whereBetween('solicitud_details.created_at',[$fi,$ff])
                            ->groupBy('solicitud','solicitud_details.grupo','examen','solicitud_details.subgrupo','price')->get();
            
            $pdf = PDF::loadView('livewire.reportes.pdfreporteporexamenes',
            [ 
                'fi'=>$fi, 
                'ff'=>$ff,
                'info' => $examenes,
            ])->output();
            return response()->streamDownload(
                fn() => print($pdf),
                'Reporte-examens-realizados-'.Carbon::now()->format('Y-m-d').'.pdf'
            );
    }

    public function PDF_EXAMEN_DETALLE()
    {
        $fi = Carbon::parse($this->fecha_ini)->format('Y-m-d').' 00:00:00';
		$ff = Carbon::parse($this->fecha_fin)->format('Y-m-d').' 23:59:59';
        if($this->fecha_ini !== '')
    	{
    		$fi = Carbon::parse($this->fecha_ini)->format('Y-m-d').' 00:00:00';
    		$ff = Carbon::parse($this->fecha_fin)->format('Y-m-d').' 23:59:59';
        }
            
            //buscamos las solicitudes del paciente en dichas fechas
            $examenes = SolicitudDetails::select('examen','price','attention',DB::raw('COUNT(examen) as cantidad'),DB::raw('COUNT(examen)*price as total'))->from(function ($q)
            {
                $q->select('solicitud','solicitud_details.grupo','e.name as examen','s.attention','price',DB::raw('s.created_at as fc'));
                $q->from('solicitud_details');
                $q->join('examenes as e','e.id','solicitud_details.exam');
                $q->join('solicitudes as s','s.id','solicitud_details.solicitud');
                $q->where('s.state_pago','CANCELADO');
                
                $q->groupBy('solicitud','solicitud_details.grupo','examen','price','fc');
            })->whereBetween('fc',[$fi,$ff])
            ->groupBy('examen','price','attention')->get();
            $total = $examenes->sum('total');
            //antiguo
            $examen = SolicitudDetails::join('examenes as e','e.id','solicitud_details.exam')
                            ->select('solicitud','solicitud_details.grupo','e.name as examen','solicitud_details.subgrupo','price',DB::raw('COUNT(price) as cantidad'))
                            ->whereBetween('solicitud_details.created_at',[$fi,$ff])
                            ->groupBy('solicitud','solicitud_details.grupo','examen','solicitud_details.subgrupo','price')->get();
            
            $pdf = PDF::loadView('livewire.reportes.pdfreporteporexamenesdetallado',
            [ 
                'fi'=>$fi, 
                'ff'=>$ff,
                'info' => $examenes,
                'total' => $total,
            ])->output();
            return response()->streamDownload(
                fn() => print($pdf),
                'Ingresos-por-examenes-'.Carbon::now()->format('Y-m-d').'.pdf'
            );
    }
    public function export()
    {
        if($this->fecha_ini == '' || $this->fecha_fin == '')
    	{
    		$this->emit('msg-warning', 'Seleccione rango de fechas');
        }else{
            return Excel::download(new ReportExamsExport($this->fecha_ini,$this->fecha_fin), 'Ingresos-por-examenes-'.Carbon::now()->format('Y-m-d').'.xlsx');
        }
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
    public function GUARDAR()
    {       
        $fi = Carbon::parse($this->fecha_ini)->format('Y-m-d').' 00:00:00';
		$ff = Carbon::parse($this->fecha_fin)->format('Y-m-d').' 23:59:59';
        if($this->fecha_ini !== '')
    	{
    		$fi = Carbon::parse($this->fecha_ini)->format('Y-m-d').' 00:00:00';
    		$ff = Carbon::parse($this->fecha_fin)->format('Y-m-d').' 23:59:59';
        }
            
            //buscamos las solicitudes del paciente en dichas fechas
            $examenes = SolicitudDetails::select('examen','price','attention',DB::raw('COUNT(examen) as cantidad'),DB::raw('COUNT(examen)*price as total'))->from(function ($q)
            {
                $q->select('solicitud','solicitud_details.grupo','e.name as examen','s.attention','price',DB::raw('s.created_at as fc'));
                $q->from('solicitud_details');
                $q->join('examenes as e','e.id','solicitud_details.exam');
                $q->join('solicitudes as s','s.id','solicitud_details.solicitud');
                $q->where('s.state_pago','CANCELADO');
                //$q->whereBetween('solicitud_details.created_at',[$fi,$ff]);
                $q->groupBy('solicitud','solicitud_details.grupo','examen','price','fc');
            })->whereBetween('fc',[$fi,$ff])
            ->groupBy('examen','price','attention')->get();
            $total = $examenes->sum('total');
            //antiguo
            $examen = SolicitudDetails::join('examenes as e','e.id','solicitud_details.exam')
                            ->select('solicitud','solicitud_details.grupo','e.name as examen','solicitud_details.subgrupo','price',DB::raw('COUNT(price) as cantidad'))
                            ->whereBetween('solicitud_details.created_at',[$fi,$ff])
                            ->groupBy('solicitud','solicitud_details.grupo','examen','solicitud_details.subgrupo','price')->get();
            
            $pdf = PDF::loadView('livewire.reportes.pdfreporteporexamenesdetallado',
            [ 
                'fi'=>$fi, 
                'ff'=>$ff,
                'info' => $examenes,
                'total' => $total,
            ])->output();
        //guardar el roporte
        \Storage::put('reportes_por_examen/Del '.$this->fecha_ini.' a '.$this->fecha_fin.'.pdf', $pdf);
        return $this->emit('msgok', 'Reporte guardado con Exito');
    }
    protected $listeners = [
        'PDF_EXAMEN'    => 'PDF_EXAMEN',
        'PDF_EXAMEN_DETALLE'    => 'PDF_EXAMEN_DETALLE',
        'EXPORT_EXCEL'    => 'export',
        'descargar' => 'descargar',
        'eliminar' => 'eliminar',
        'GUARDAR' => 'GUARDAR'
    ];

}
    