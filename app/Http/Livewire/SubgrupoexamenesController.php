<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Examen;
use App\Models\Subgrupoexamen;
use App\Models\Valoresexamen;

class SubgrupoexamenesController extends Component
{
    
    use WithPagination;
    protected $paginationTheme='bootstrap';
    
    public $examen='Elegir',
    $name,
    $state='Activo',
    $examenes;

    //
    public $selected_id, $search;
    public $action=1, $pagination = 10;
    //
    protected $messages = [
        'name.required' => 'El nombre del Subgrupo de exámen es requerido.',
        'examen.required' => 'El exámen al que pertenece es requerido.',
        'state.required' => 'El estado es requerido.',
    ];
   
    public function render()
    {
        //llenar el select
        $this->examenes = Examen::leftjoin('grupos as g','g.id','examenes.grupo')->select('examenes.id','g.name as grupo','examenes.name as examen')->where('examenes.state','Activo')->get();
        if(strlen($this->search) > 0){
            $info = Subgrupoexamen::leftjoin('examenes as e','e.id','subgrupoexamenes.examen')
            ->select('subgrupoexamenes.*','e.name as examen')
            ->where('subgrupoexamenes.name','like','%'. $this->search.'%')
            ->orwhere('subgrupoexamenes.state','like',$this->search.'%')
            ->paginate($this->pagination);
            return view('livewire.subgrupoexamenes.component',[
                'info'=>$info,

            ]);
        }
        else{
            $info = subgrupoexamen::leftjoin('examenes as e','e.id','subgrupoexamenes.examen')
            ->select('subgrupoexamenes.*','e.name as examen')
            ->orderBy('subgrupoexamenes.id', 'asc')
            ->paginate($this->pagination);
            return view('livewire.subgrupoexamenes.component',[
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
        $this->examen='Elegir';
        $this->state='Activo';
        $this->selected_id = null;
        $this->action = 1;
        $this->search = '';
    }

    public function edit($id)
    {
        $record = Subgrupoexamen::find($id);
        $this->selected_id = $id;
        $this->name = $record->name;
        $this->state=$record->state;
        $this->examen = $record->examen;
        $this->action=2;
    }


    public function StoreOrUpdate()
    {
        $this->validate([
            'examen' => 'not_in:Elegir',
            'name' => 'required',
            'state' => 'required',
            
        ]);

        if($this->selected_id <= 0)
        {    
            $subgrupoexamen = Subgrupoexamen::create([
                'name' => $this->name,
                'state' => $this->state,
                'examen' => $this->examen,
            ]);
        } 
        else{
            $record = Subgrupoexamen::find($this->selected_id);
            $record-> update([
                'name' => $this->name,
                'state' => $this->state,
                'examen' => $this->examen,
            ]);
        }
        if($this->selected_id)
            $this->emit('msgok', 'subgrupoexamen Actualizado con Exito');
        else
            $this->emit('msgok', 'subgrupoexamen Creado con Exito');
        $this->resetInput();
    }
    public function destroy($id)
    {
        $tienevalores = Valoresexamen::where('subgrupoexamen',$id)->get();
        if($tienevalores->count() > 0){
            $this->emit('msg-error', 'El subgrupo que quiere eliminar tiene valores registrados');
        }
        else 
        if ($id) {
            $record = Subgrupoexamen::where('id', $id);
            $record->delete();
            $this->resetInput();
            $this->emit('msgok', 'subgrupo de examen eliminado con éxito');
        }
    }

    //listeners / escuchamos evento y ejecutar acciones
    protected $listeners = [
        'deleteRow' => 'destroy'
    ];
}
