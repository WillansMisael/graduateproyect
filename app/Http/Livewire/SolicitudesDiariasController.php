<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Solicitud;
use Carbon\Carbon;
use DB;
use Barryvdh\DomPDF\Facade as PDF;

class SolicitudesDiariasController extends Component
{
   
    public function render()
    {
        $solicitudes = Solicitud::leftjoin('pacientes as p','p.id','solicitudes.pacient')
            ->leftjoin('medicos as m','m.id','solicitudes.medic')
            ->select('solicitudes.*',DB::raw("CONCAT(p.name,' ',p.last_name) as paciente"),DB::raw("CONCAT(m.name,' ',m.last_name) as medico"))
            ->whereDate('solicitudes.created_at',Carbon::today())
            ->orderBy('solicitudes.id', 'DESC')->get();

        $total = Solicitud::whereDate('solicitudes.created_at',Carbon::today())->sum('pago');
                
        
       return view('livewire.reportes.solicitudes-diarias',[
        'info' => $solicitudes,
        'sumaTotal' => $total
        ]);
    }

    public function PDF_Normal()
    {
        dd('hola');
        $solicitudes = Solicitud::leftjoin('pacientes as p','p.id','solicitudes.pacient')
            ->leftjoin('medicos as m','m.id','solicitudes.medic')
            ->select('solicitudes.*',DB::raw("CONCAT(p.name,' ',p.last_name) as paciente"),DB::raw("CONCAT(m.name,' ',m.last_name) as medico"))
            ->whereDate('solicitudes.created_at',Carbon::today())
            ->orderBy('solicitudes.id', 'DESC')->get();

        $total = Solicitud::whereDate('solicitudes.created_at',Carbon::today())->sum('pago');
  
                            
       $pdf = PDF::loadView('livewire.reportes.pdfsolicitudesdiarias',
       ['info' => $solicitudes,
       'sumaTotal' => $total
       ])->output();
       return response()->streamDownload(
          fn() => print($pdf),
          'solicitudes-diarias-'.Carbon::now()->format('Y-m-d').'.pdf'
       );

    }
   
    protected $listeners = [
        'PDF_Normal'    => 'PDF_Normal',
    ];
}
