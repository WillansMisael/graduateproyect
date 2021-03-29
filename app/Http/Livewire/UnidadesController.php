<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Unidad;

class UnidadesController extends Component
{   
    use withPagination;
    protected $paginationTheme='bootstrap';
    
    //variables o propiedades publicas
    //campos de la tabla
    public $description;
    public $unit;
    public $state="Activo";
    //editar filas y busqueda
    public $selected_id, $search;
    public $action = 1; //movernos entre formularios
    public $pagination = 100;
    //
    protected $messages = [
        'description.required' => 'La descripción de la unidad es requerida.',
        'unit.required' => 'La unidad es requerida.',
        'state.required' => 'El estado es requerido.',
    ];
    //primer ejecucion antes de iniciarse el componente
    public function mount()
    {               
        //inicializar variables / data
    }
    public function render()
    {
        //vemos si estan buscando algo y hacemos la busqueda en la tabla para retornarlo
        if(strlen($this->search) > 0)
        {
            $info = Unidad::where('unit', 'like', '%' .  $this->search . '%')
            ->orwhere('description','like','%'. $this->search.'%')
            ->orwhere('state','like',   $this->search.'%')
            ->paginate(5);
            return view('livewire.unidades.component',[
                'info'=>$info,
            ]);
        }else {
            // caso contrario solo retornamos el componente inyectado con 5 registros
               return view('livewire.unidades.component', [
                'info' => Unidad::paginate(100),
            ]);
           }
    }
    // para busquedas con paginacion
    public function updatingSearch():void
    {
        $this->gotoPage(1);
    }

    // movernos entre ventanas form
    public function doAction($action)
    {
        $this->resetInput();
        $this->action = $action;
    }
    

    //limpiar variables
    public function resetInput()
    {
        $this->description = '';
        $this->unit = '';
        $this->state = 'Activo';
        $this->selected_id = null;
        $this->action = 1;
        $this->search = '';
    }
    //mostrar la info del registro a editar
    public function edit($id)
    {
        $record = Unidad::find($id);
        $this->selected_id = $id;
        $this->description = $record->description;
        $this->unit = $record->unit;
        $this->state = $record->state;
        $this->action = 2;
    }
    //crear o editar elementos
    public function StoreOrUpdate()
    {
        //validar campos requeridos
        $this->validate([
            'description' => 'required',
            'unit' => 'required',
            'state' => 'required',
        ]);

        //validar si existe otro registro con el mismo nombre
        if($this->selected_id > 0)
        {
            $existe = Unidad::where('unit', $this->unit)->where('id', '<>',$this->selected_id)->select('unit')->get();
            if($existe->count() > 0) {
                session()->flash('msg-error', 'Ya existe otro registro con el mismo nombre');
                $this->resetInput();
                return;
            }
        }else {
            $existe = Unidad::where('unit', $this->unit)->select('unit')->get();
            if($existe->count() > 0) {
                session()->flash('msg-error', 'Ya existe otro registro con el mismo nombre');
                $this->resetInput();
                return;
        }
    }
    if($this->selected_id <= 0){
        //creamos registro
        $record = Unidad::create([
            'description' => $this->description,
            'unit' => $this->unit,
            'state' => $this->state,
        ]);
    } else {
        //buscamos el registro
        $record = Unidad::find($this->selected_id);
        //actualizamos
        $record->update([
            'description' => $this->description,
            'unit' => $this->unit,
            'state' => $this->state,
        ]);
    }
    if($this->selected_id)
        session()->flash('message','Unidad Actualizada');
    else
        session()->flash('message','Unidad Creada');    
        //limpiar campos
        $this->resetInput();
    }
    public function destroy($id)
    {
        if ($id) {
            $record = Unidad::where('id', $id);
            $record->delete();
            $this->resetInput();
            $this->emit('msgok', 'Paciente eliminado con Exito');
        }
    }

    //listeners / escuchamos evento y ejecutar acciones
    protected $listeners = [
        'deleteRow' => 'destroy'
    ];
}
