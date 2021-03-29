<?php

namespace App\Exports;

use App\Models\SolicitudDetails;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use DB;
class ReportExamsExport implements FromView
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
        return view('exports.reporteexamenes',[
        'examenes'=>SolicitudDetails::join('examenes as e','e.id','solicitud_details.exam')
        ->join('solicitudes as s','s.id','solicitud_details.solicitud')
        ->where('s.state_pago','CANCELADO')
        ->select('solicitud_details.solicitud','solicitud_details.grupo','e.name','solicitud_details.price',DB::raw('COUNT(solicitud_details.exam) as cantidad'))
        ->groupBy('solicitud_details.solicitud','solicitud_details.grupo','e.name','solicitud_details.price')
        ->groupBy('solicitud_details.grupo')
        ->whereBetween('solicitud_details.created_at',[$this->fi,$this->ff])
        ->get(),
        ]);    
    }
}
