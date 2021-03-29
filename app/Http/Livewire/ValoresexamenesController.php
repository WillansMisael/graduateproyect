<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Subgrupoexamen;
use App\Models\Valoresexamen;
use App\Models\SolicitudDetails;
use App\Models\Unidad;

class ValoresexamenesController extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';
    
    public $subgrupoexamen='Elegir',$unidad='Elegir',
    $name,
    $rango_normal,
    $state='Activo',
    $subgrupoexamenes,
    $unidades;  

    //
    public $selected_id, $search;
    public $action=1, $pagination = 10;

    protected $messages = [
        'subgrupoexamen.required' => 'El Subgrupo de exámen al que pertenece es requerido.',
        'unidad.required' => 'La unidad del examen es requerida.',
        'name.required' => 'El nombre del valor es requerido.',
        'state.required' => 'El estado es requerido.',
        'rango_normal.required' => 'El rango normal es requerido.',
    ];

    public function render()
    {
       
        //llenar el select
        $this->subgrupoexamenes = Subgrupoexamen::leftjoin('examenes as e','e.id','subgrupoexamenes.examen')
        ->leftjoin('grupos as g','g.id','e.grupo')
        ->select('subgrupoexamenes.id','subgrupoexamenes.name as subgrupo','e.name as examen','g.name as grupo')->where('subgrupoexamenes.state','Activo')->get();
        $this->unidades = Unidad::all()->where('state','Activo');
        if(strlen($this->search) > 0){
            $info = Valoresexamen::leftjoin('subgrupoexamenes as sge','sge.id','valoresexamenes.subgrupoexamen')
            ->leftjoin('unidades as u','u.id','valoresexamenes.unidad')
            ->select('valoresexamenes.*','sge.name as subgrupoexamen','u.unit as unidad')
            ->where('valoresexamenes.name','like','%'. $this->search.'%')
            ->orwhere('valoresexamenes.state','like',$this->search.'%')
            ->orwhere('sge.name','like',$this->search.'%')
            ->paginate($this->pagination);
            return view('livewire.valoresexamenes.component',[
                'info'=>$info,

            ]);
        }
        else{
            $info = Valoresexamen::leftjoin('subgrupoexamenes as sge','sge.id','valoresexamenes.subgrupoexamen')
            ->leftjoin('unidades as u','u.id','valoresexamenes.unidad')
            ->select('valoresexamenes.*','sge.name as subgrupoexamen','u.unit as unidad')
            ->orderBy('valoresexamenes.id', 'asc')
            ->paginate($this->pagination);
            return view('livewire.valoresexamenes.component',[
                'info'=>$info,

            ]);
        }
    }
    //paginado por busqueda
    public function updatingSearch()
    {
        $this->gotoPage(1);
    }
    public function doAction($action)
    {
        $this->resetInput();
        $this->action = $action;
    }

    public function resetInput()
    {
        $this->name = '';
        $this->subgrupoexamen='Elegir';
        $this->unidad='Elegir';
        $this->rango_normal='';
        $this->state='Activo';
        $this->selected_id = null;
        $this->action = 1;
        $this->search = '';
    }

    public function edit($id)
    {
        $record = Valoresexamen::find($id);
        $this->selected_id = $id;
        $this->name = $record->name;
        $this->state=$record->state;
        $this->rango_normal=$record->rango_normal;
        $this->subgrupoexamen = $record->subgrupoexamen;
        $this->unidad = $record->unidad;
        $this->action=2;
    }
    public function StoreOrUpdate()
    {
        $this->validate([
            'subgrupoexamen' => 'not_in:Elegir',
            'unidad' => 'not_in:Elegir',
            'name' => 'required',
            'rango_normal' => 'required',
            'state' => 'required',
            
        ]);

        if($this->selected_id <= 0)
        {    
            $subgrupoexamen = Valoresexamen::create([
                'subgrupoexamen' => $this->subgrupoexamen,
                'unidad' => $this->unidad,
                'name' => $this->name,
                'rango_normal' => $this->rango_normal,
                'state' => $this->state,
                ]);
        } 
        else{
            $record = Valoresexamen::find($this->selected_id);
            $record-> update([
                'subgrupoexamen' => $this->subgrupoexamen,
                'unidad' => $this->unidad,
                'name' => $this->name,
                'rango_normal' => $this->rango_normal,
                'state' => $this->state,
            ]);
        }
        if($this->selected_id)
            $this->emit('msgok', 'Valores examen Actualizado con Exito');
        else
            $this->emit('msgok', 'Valores examen Creado con Exito');
        $this->resetInput();
    }
    public function destroy($id)
    {
        $valoresSolicitud= SolicitudDetails::where('valores',$id)->get();
        if($valoresSolicitud->count() > 0){
            $this->emit('msg-error', 'El valor que quiere eliminar se encuentra en solicitudes anteriores, si ya no desea visualizar dicho valor se recomienda cambiar de estado a "INACTIVO"');
        }
        else if ($id) {
            $record = Valoresexamen::where('id', $id);
            $record->delete();
            $this->resetInput();
            $this->emit('msgok', 'Valores examen  eliminado con Exito');
        }
    }

    //listeners / escuchamos evento y ejecutar acciones
    protected $listeners = [
        'deleteRow' => 'destroy'
    ];
}
