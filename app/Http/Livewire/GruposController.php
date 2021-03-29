<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Grupo;
use App\Models\Familia;
use App\Models\Examen;

class GruposController extends Component
{
    
    use WithPagination;
    protected $paginationTheme='bootstrap';

    public $familia='Elegir',
    $name,
    $state='Activo',
    $familias;

    //
    public $selected_id, $search;
    public $action=1, $pagination = 10;
    //
    protected $messages = [
        'name.required' => 'El nombre del grupo es requerido.',
        'state.required' => 'El estado es requerido.',
    ];

    public function render()
    {
        //llenar el select
        $this->familias = Familia::all()->where('state','Activo');
        if(strlen($this->search) > 0){
            $info = Grupo::leftjoin('familias as f','f.id','grupos.familia')
            ->select('grupos.*','f.name as familia')
            ->where('grupos.name','like','%'. $this->search.'%')
            ->orwhere('grupos.state','like',$this->search.'%')
            ->paginate($this->pagination);
            return view('livewire.grupos.component',[
                'info'=>$info,

            ]);
        }
        else{
            $info = Grupo::leftjoin('familias as f','f.id','grupos.familia')
            ->select('grupos.*','f.name as familia')
            ->orderBy('grupos.id', 'asc')
            ->paginate($this->pagination);
            return view('livewire.grupos.component',[
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
        $this->familia='Elegir';
        $this->state='Activo';
        $this->selected_id = null;
        $this->action = 1;
        $this->search = '';
    }

    public function edit($id)
    {
        $record = Grupo::find($id);
        $this->selected_id = $id;
        $this->name = $record->name;
        $this->state=$record->state;
        $this->familia = $record->familia;
        $this->action=2;
    }


    public function StoreOrUpdate()
    {
        $this->validate([
            'familia' => 'not_in:Elegir',
            'name' => 'required',
            'state' => 'required',
            
        ]);

        if($this->selected_id <= 0)
        {    
            $grupo = Grupo::create([
                'name' => $this->name,
                'state' => $this->state,
                'familia' => $this->familia,
            ]);
        } 
        else{
            $record = Grupo::find($this->selected_id);
            $record-> update([
                'name' => $this->name,
                'state' => $this->state,
                'familia' => $this->familia,
            ]);
        }
        if($this->selected_id)
            $this->emit('msgok', 'Grupo Actualizado con Exito');
        else
            $this->emit('msgok', 'Grupo Creado con Exito');
        $this->resetInput();
    }
    public function destroy($id)
    {
        $tieneexamenes = Examen::where('grupo',$id)->get();
        if($tieneexamenes->count() > 0){
            $this->emit('msg-error', 'El Grupo que quiere eliminar tiene exámenes registrados');
        }
        else 
        if ($id) {
            $record = Grupo::where('id', $id);
            $record->delete();
            $this->resetInput();
            $this->emit('msgok', 'Grupo eliminado con Exito');
        }
    }

    //listeners / escuchamos evento y ejecutar acciones
    protected $listeners = [
        'deleteRow' => 'destroy'
    ];
}

