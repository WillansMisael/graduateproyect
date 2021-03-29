<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Institucion;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;

class InstitucionesController extends Component
{
    use withPagination;
    protected $paginationTheme='bootstrap';
    //variables o propiedades publicas
    //campos de la tabla
    public $name;
    public $telephone;
    public $email;
    public $direction;
    public $state="Activo";
    //editar filas y busqueda
    public $selected_id, $search;
    public $action = 1; //movernos entre formularios
    public $pagination = 5;
    
    protected $messages = [
        'name.required' => 'El nombre de la institución es requerido.',
        'telephone.required' => 'Es necesario un número de referencia.',
        'direction.required' => 'Es necesario una dirección de referencia.'
    ];

    //primer ejecucion antes de iniciarse el componente
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
            $info = Institucion::where('name', 'like', '%' .  $this->search . '%')
            ->paginate(5);
            return view('livewire.instituciones.component',[
                'info'=>$info,
            ]);
        }else {
            // caso contrario solo retornamos el componente inyectado con 5 registros
                return view('livewire.instituciones.component', [
                'info' => Institucion::paginate(5),
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
        $this->name = '';
        $this->telephone = '';
        $this->email = '';
        $this->direction = '';
        $this->state = 'Activo';
        $this->selected_id = null;
        $this->action = 1;
        $this->search = '';
    }

    //mostrar la info del registro a editar
    public function edit($id)
    {
        $record = Institucion::findOrFail($id);
        $this->selected_id = $id;
        $this->name = $record->name;
        $this->telephone = $record->telephone;
        $this->email = $record->email;
        $this->direction = $record->direction;
        $this->state = $record->state;
        $this->action = 2;
    }

    //crear o editar elementos
    public function StoreOrUpdate()
    {
        //validar campos requeridos
        $this->validate([
            'name' => 'required',
            'telephone' => 'required|min:6',
            'email' => '',
            'direction' => 'required',
            'state' => 'required',
        ]);
        
        //validar si existe otro registro con el mismo nombre
        if($this->selected_id > 0)
        {
            $existe = Institucion::where('name', $this->name)->where('id', '<>',$this->selected_id)->select('name')->get();
            if($existe->count() > 0) {
                session()->flash('msg-error', 'Ya existe otro registro con le mismo nombre');
                $this->resetInput();
                return;
            }
        }else {
            $existe = Institucion::where('name', $this->name)->select('name')->get();
            if($existe->count() > 0) {
                session()->flash('msg-error', 'Ya existe otro registro con le mismo nombre');
                $this->resetInput();
                return;
        }
    }
    if($this->selected_id <= 0){
        
        //creamos registro
        $record = Institucion::create([
            'name' => $this->name,
            'telephone' => $this->telephone,
            'email' => $this->email,
            'direction' => $this->direction,
            'state' => $this->state,
        ]);
    } else {
        //buscamos el registro
        $record = Institucion::find($this->selected_id);
        //actualizamos
        $record->update([
            'name' => $this->name,
            'telephone' => $this->telephone,
            'email' => $this->email,
            'direction' => $this->direction,
            'state' => $this->state,

        ]);
    }
    if($this->selected_id){
        session()->flash('message','Institucion Actualizada');}
    else{
        session()->flash('message','Institucion Creada');}
        //limpiar campos
        $this->resetInput();
    }
    //eliminar registros
    public function destroy($id)
    {
        if($id){
            $record = Institucion::where('id', $id);;
            $record->delete();
            $this->resetInput();
        }
    }
    public function PDF()
    {

        $pdf = PDF::loadView('livewire.instituciones.pdf',
        ['info' => Institucion::all(),
        ])->output();
        return response()->streamDownload(
            fn() => print($pdf),
            'instituciones-lab-'.Carbon::now()->format('Y-m-d').'.pdf'
        );

    }

    //listeners / escuchamos evento y ejecutar acciones
    protected $listeners = [
        'deleteRow' => 'destroy',
        'PDF' => 'PDF'
    ];
}
