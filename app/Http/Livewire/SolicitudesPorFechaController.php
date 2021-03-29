<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Solicitud;
use Carbon\Carbon;
use DB;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportSolicitudExport;
use Spatie\Backup\Helpers\Format;

class SolicitudesPorFechaController extends Component
{

	public $fecha_ini, $fecha_fin;

    public function render()
    {
        
        
        if($this->fecha_ini !== '')
    	{
    		$fi = Carbon::parse($this->fecha_ini)->format('Y-m-d').' 00:00:00';
    		$ff = Carbon::parse($this->fecha_fin)->format('Y-m-d').' 23:59:59';
        }
        if($this->fecha_ini > $this->fecha_fin)
    	{
    		$this->emit('msg-warning', 'Falta rango de fechas o rango de fechas no válido, por favor revise las fechas ingresadas.');
        }
        $solicitudes = Solicitud::leftjoin('pacientes as p','p.id','solicitudes.pacient')
            ->leftjoin('medicos as m','m.id','solicitudes.medic')
            ->select('solicitudes.*',DB::raw("CONCAT(p.name,' ',p.last_name) as paciente"),DB::raw("CONCAT(m.name,' ',m.last_name) as medico"))
            ->whereBetween('solicitudes.created_at',[$fi , $ff ])
            ->orderBy('solicitudes.id', 'DESC')->get();

        $total = Solicitud::whereBetween('solicitudes.created_at',[$fi , $ff])->sum('pago');
                
        
        $directory = storage_path('app\reportes_por_fecha');
        $files = \Storage::files('reportes_por_fecha');
        //dd($files);

        return view('livewire.reportes.solicitudes-por-fecha',[
        'info' => $solicitudes,
        'sumaTotal' => $total,
        'archivos'=> $files
    ]);
    }

    public function PDF()
    {
        $fi = Carbon::parse(Carbon::now())->format('Y-m-d').' 00:00:00';
    	$ff = Carbon::parse(Carbon::now())->format('Y-m-d').' 23:59:59';
        
        if($this->fecha_ini !== '')
    	{
    		$fi = Carbon::parse($this->fecha_ini)->format('Y-m-d').' 00:00:00';
    		$ff = Carbon::parse($this->fecha_fin)->format('Y-m-d').' 23:59:59';
        }

        $solicitudes = Solicitud::leftjoin('pacientes as p','p.id','solicitudes.pacient')
            ->leftjoin('medicos as m','m.id','solicitudes.medic')
            ->select('solicitudes.*',DB::raw("CONCAT(p.name,' ',p.last_name) as paciente"),DB::raw("CONCAT(m.name,' ',m.last_name) as medico"))
            ->whereBetween('solicitudes.created_at',[$fi , $ff ])
            ->orderBy('solicitudes.id', 'DESC')->get();

        $total = Solicitud::whereBetween('solicitudes.created_at',[$fi , $ff])->sum('pago');
                
        
        $pdf = PDF::loadView('livewire.reportes.pdfsolicitudesporfecha',
        [ 
            'fi'=>$fi, 
            'ff'=>$ff,
            'info' => $solicitudes,
            'sumaTotal' => $total
        ])->output();
        //guardar el roporte
        
        return response()->streamDownload(
           fn() => print($pdf),
           'Reporte-Por-Fechas-'.Carbon::now()->format('Y-m-d').'.pdf',
        );
    }
    public function export()
    {
        if($this->fecha_ini == '' || $this->fecha_fin == '')
    	{
    		$this->emit('msg-warning', 'Seleccione rango de fechas');
        }else{
            return Excel::download(new ReportSolicitudExport($this->fecha_ini,$this->fecha_fin), 'Reporte-Por-Fechas-'.Carbon::now()->format('Y-m-d').'.xlsx');
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
        $fi = Carbon::parse(Carbon::now())->format('Y-m-d').' 00:00:00';
    	$ff = Carbon::parse(Carbon::now())->format('Y-m-d').' 23:59:59';
        
        if($this->fecha_ini !== '')
    	{
    		$fi = Carbon::parse($this->fecha_ini)->format('Y-m-d').' 00:00:00';
    		$ff = Carbon::parse($this->fecha_fin)->format('Y-m-d').' 23:59:59';
        }

        $solicitudes = Solicitud::leftjoin('pacientes as p','p.id','solicitudes.pacient')
            ->leftjoin('medicos as m','m.id','solicitudes.medic')
            ->select('solicitudes.*',DB::raw("CONCAT(p.name,' ',p.last_name) as paciente"),DB::raw("CONCAT(m.name,' ',m.last_name) as medico"))
            ->whereBetween('solicitudes.created_at',[$fi , $ff ])
            ->orderBy('solicitudes.id', 'DESC')->get();

        $total = Solicitud::whereBetween('solicitudes.created_at',[$fi , $ff])->sum('pago');
                
        
        $pdf = PDF::loadView('livewire.reportes.pdfsolicitudesporfecha',
        [ 
            'fi'=>$fi, 
            'ff'=>$ff,
            'info' => $solicitudes,
            'sumaTotal' => $total
        ])->output();
        //guardar el roporte
        \Storage::put('reportes_por_fecha/Del '.$this->fecha_ini.' a '.$this->fecha_fin.'.pdf', $pdf);
        return $this->emit('msgok', 'Reporte guardado con Exito');
    }
    protected $listeners = [
        'PDF'    => 'PDF',
        'EXPORT_EXCEL'    => 'export',
        'descargar' => 'descargar',
        'eliminar' => 'eliminar',
        'GUARDAR' => 'GUARDAR'
    ];
}
