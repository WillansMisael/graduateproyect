<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Valoresexamen;
use App\Models\Familia;
use App\Models\Grupo;
use App\Models\Examen;
use App\Models\Subgrupoexamen;
use App\Models\Solicitud;
use App\Models\Paciente;
use App\Models\SolicitudDetails;

class ExamenescompletosController extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';
    
    public  $search;
    public $pagination = 10;
    public function render()
    {
    
        $re = SolicitudDetails::select('solicitud','grupo','exam','valores','result')
        ->groupBy('solicitud','grupo','exam','valores','result')->where('solicitud',4)->distinct('exam')->get();
        $grupo = $re->where('grupo','==',11);
        //dd(($grupo));
        
        $data = Familia::with(['grupo' => function ($q){$q->with(['examen' => function ($q){$q->with(['subgrupo'=> function ($q){$q->with('valexamen');}]);}]);}])->get();
        
        //dd($data);
        if(strlen($this->search) > 0){
            $info = Valoresexamen::leftjoin('subgrupoexamenes as sge','sge.id','valoresexamenes.subgrupoexamen')
            ->leftjoin('examenes as e','e.id','sge.examen')
            ->leftjoin('grupos as g','g.id','e.grupo')
            ->leftjoin('familias as f','f.id','g.familia')
            ->select('f.name as familia','g.name as grupos','e.name as examenes','sge.name as subgrupoexamen','valoresexamenes.name as valores')
            ->where('f.name','like',$this->search.'%')
            ->orwhere('e.name','like',$this->search.'%')
            ->orwhere('g.name','like',$this->search.'%')
            ->orwhere('sge.name','like',$this->search.'%')
            ->orwhere('valoresexamenes.name','like',$this->search.'%')
            ->paginate($this->pagination);
            $total = Examen::count();
            return view('livewire.examenescompletos.component',[
                'info'=>$info,'total'=>$total

            ]);
        } else{
            $info = Valoresexamen::leftjoin('subgrupoexamenes as sge','sge.id','valoresexamenes.subgrupoexamen')
            ->leftjoin('examenes as e','e.id','sge.examen')
            ->leftjoin('grupos as g','g.id','e.grupo')
            ->leftjoin('familias as f','f.id','g.familia')
            ->select('f.name as familia','g.name as grupos','e.name as examenes','sge.name as subgrupoexamen','valoresexamenes.name as valores')
            ->paginate($this->pagination);
            $total = Examen::count();
            return view('livewire.examenescompletos.component',[
                'info'=>$info,'total'=>$total,
                'data'=>$data,
            ]);
        
        }
    
    }
     
}
