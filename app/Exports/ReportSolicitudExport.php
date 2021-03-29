<?php

namespace App\Exports;

use App\Models\Solicitud;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class ReportSolicitudExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(string $fi, string $ff)
    {
        $this->fi = $fi;
        $this->ff = $ff;
    }
    public function view(): View 
    {   
        return view('exports.reportesolicitud',[
        'solicitud'=> Solicitud::leftjoin('pacientes as p','p.id','solicitudes.pacient')
        ->leftjoin('medicos as m','m.id','solicitudes.medic')
        ->select('solicitudes.*',DB::raw("CONCAT(p.name,' ',p.last_name) as paciente"),DB::raw("CONCAT(m.name,' ',m.last_name) as medico"))
        ->whereBetween('solicitudes.created_at',[$this->fi , $this->ff])
        ->orderBy('solicitudes.id', 'DESC')->get()
        //'total' =
        ]);    
    }
}
