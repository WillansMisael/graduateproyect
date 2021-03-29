<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Solicitud;
use App\Models\SolicitudDetails;
use App\Models\Medico;
use DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;

class VistaDatosMedicoController extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';
    public $search, $action=1, $pagination = 10;
    
    public function render()
    {
        //numero de solicitudes
        $numero_de_solicitudes = Solicitud::leftjoin('medicos as m','m.id','solicitudes.medic')->where('m.user',auth()->user()->id)->count();
        //datos del medico
        $medico = Medico::where('user', auth()->user()->id)->get();

        if(strlen($this->search) > 0){
            $solicitudes = Solicitud::leftjoin('pacientes as p','p.id','solicitudes.pacient')
            ->leftjoin('medicos as m','m.id','solicitudes.medic')
            ->select('solicitudes.*','solicitudes.id as num_solicitud','solicitudes.state_result as estado_solicitud','p.*')
            ->where('m.user', auth()->user()->id)
            ->where('p.last_name','like',$this->search.'%')
            ->orderBy('solicitudes.id','DESC')
            ->paginate($this->pagination);
            return view('livewire.vistadatosmedico.component',[
                'solicitudes'=>$solicitudes,
                'medico'=>$medico,
                'numero_de_solicitudes'=>$numero_de_solicitudes,
            ]);
        }
        
        $solicitudes = Solicitud::leftjoin('pacientes as p','p.id','solicitudes.pacient')
            ->leftjoin('medicos as m','m.id','solicitudes.medic')
            ->select('solicitudes.*','solicitudes.id as num_solicitud','solicitudes.state_result as estado_solicitud','p.*')
            ->where('m.user', auth()->user()->id)
            ->orderBy('solicitudes.id', 'DESC')
            ->paginate($this->pagination);

            return view('livewire.vistadatosmedico.component',[
                'solicitudes'=>$solicitudes,
                'medico'=>$medico,
                'numero_de_solicitudes'=>$numero_de_solicitudes,
            ]);
        
    }
    public function Pdf($id)
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
        'origen' => 'El siguiente documento es una copia de los resultados finales originada desde el perfil del médico.'
       ])->output();
       $pdf = preg_replace("/>s+</", "><", $pdf);
       return response()->streamDownload(
          fn() => print($pdf),
          'Resultados-'.$id.'-'.Carbon::now()->format('Y-m-d').'.pdf'
       );

    }
    protected $listeners = [
        'Pdf'    => 'Pdf',
    ];
}
