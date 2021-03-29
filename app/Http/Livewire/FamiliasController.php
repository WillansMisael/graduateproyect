<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Familia;
use App\Models\Grupo;

class FamiliasController extends Component
{
    use withPagination;
    protected $paginationTheme='bootstrap';
    
    public $name, $description, $state="Activo";
    public $selected_id, $search;
    public $action = 1; //movernos entre formularios
    public $pagination = 5;

    //
    protected $messages = [
        'name.required' => 'El nombre de la Familia es requerida.',
        'description.required' => 'La descripcion de la Familia es requerida',
    ];
    public function mount()
    {               
        //inicializar variables / data
    }
    // se ejecuta despues del mount
    public function render()
    {
        //vemos si estan buscando algo y hacemos la busqueda en la tabla para retornarlo
        if(strlen($this->search) > 0)
        {
            $info = Familia::where('name', 'like', '%' .  $this->search . '%')
            ->orwhere('description', 'like', '%' .  $this->search . '%')
            ->paginate(5);
            return view('livewire.familias.component',[
                'info'=>$info,
            ]);
        }else {
            // caso contrario solo retornamos el componente inyectado con 5 registros
               return view('livewire.familias.component', [
                'info' => Familia::paginate(5),
            ]);
           }
    }
    public function allexam()
    {
        return view('livewire.familias.allexam');
    }
    // para busquedas con paginacion
    public function updatingSearch():void
    {
        $this->gotoPage(1);
    }

    // movernos entre ventanas form
    public function doAction($action)
    {
        if($action==1){
            $this->resetInput();
            $this->action = $action;
        } else{
            $this->action = $action;

        }

    }
    

    //limpiar variables
    public function resetInput()
    {
        $this->name = '';
        $this->description = '';
        $this->state = 'Activo';
        $this->selected_id = null;
        $this->action = 1;
        $this->search = '';
    }
    //mostrar la info del registro a editar
    public function edit($id)
    {
        $record = Familia::findOrFail($id);
        $this->selected_id = $id;
        $this->name = $record->name;
        $this->description = $record->description;
        $this->state = $record->state;
        $this->action = 2;
    }
    //crear o editar elementos
    public function StoreOrUpdate()
    {
        //validar campos requeridos
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'state' => 'required',
        ]);

        //validar si existe otro registro con el mismo nombre
        if($this->selected_id > 0)
        {
            $existe = Familia::where('name', $this->name)->where('id', '<>',$this->selected_id)->select('name')->get();
            if($existe->count() > 0) {
                session()->flash('msg-error', 'Ya existe otro registro con le mismo nombre');
                $this->resetInput();
                return;
            }
        }else {
            $existe = Familia::where('name', $this->name)->select('name')->get();
            if($existe->count() > 0) {
                session()->flash('msg-error', 'Ya existe otro registro con le mismo nombre');
                $this->resetInput();
                return;
            }
        }
        if($this->selected_id <= 0){
            //creamos registro
            $record = Familia::create([
                'name' => $this->name,
                'description' => $this->description,
                'state' => $this->state,
            ]);
        } else {
            //buscamos el registro
            $record = Familia::find($this->selected_id);
            //actualizamos
            $record->update([
                'name' => $this->name,
                'description' => $this->description,
                'state' => $this->state,
            ]);
        }
        if($this->selected_id)
            session()->flash('message','Familia Actualizada');
        else
            session()->flash('message','Familia Creada');
            
            //limpiar campos
            $this->resetInput();
    }
      //eliminar registros
      public function destroy($id)
      {
        $tienegrupos = Grupo::where('familia',$id)->get();
        if($tienegrupos->count() > 0){
            $this->emit('msg-error', 'La familia que quiere eliminar tiene grupos registrados');
        }
        else if($id){
            $record = Familia::where('id', $id);;
            $record->delete();
            $this->resetInput();
        }
    }

     //listeners / escuchamos evento y ejecutar acciones
     protected $listeners = [
         'deleteRow' => 'destroy'
     ];
}