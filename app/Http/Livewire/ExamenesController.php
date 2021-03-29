<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Grupo;
use App\Models\Examen;
use App\Models\Subgrupoexamen;

class ExamenesController extends Component
{
    
    use WithPagination;
    protected $paginationTheme='bootstrap';

    public $grupo='Elegir',
    $name,
    $method,
    $price_normal,
    $price_emergency,
    $state='Activo',
    $grupos;

    //
    public $selected_id, $search;
    public $action=1, $pagination =10;
    //
    protected $messages = [
        'name.required' => 'El nombre del examen es requerido.',
        'grupo.required' => 'El Grupo es requerido.',
        'price_normal.required' => 'El precio normal es requerido y en decimales',
        'price_emergency.required' => 'El precio emergencia es requerido y en decimales',
        'state.required' => 'El estado es requerido.',
    ];
    public function render()
    {
        //llenar el select
        $this->grupos = Grupo::all()->where('state','Activo');
        if(strlen($this->search) > 0){
            $info = Examen::leftjoin('grupos as g','g.id','examenes.grupo')
            ->select('examenes.*','g.name as grupo')
            ->where('examenes.name','like','%'. $this->search.'%')
            ->orwhere('g.name','like',$this->search.'%')
            ->orwhere('examenes.state','like',$this->search.'%')
            ->paginate($this->pagination);
            return view('livewire.examenes.component',[
                'info'=>$info,

            ]);
        }
        else{
            $info = Examen::leftjoin('grupos as g','g.id','examenes.grupo')
            ->select('examenes.*','g.name as grupo')
            ->orderBy('examenes.id', 'asc')
            ->paginate($this->pagination);
            return view('livewire.examenes.component',[
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
        $this->method='';
        $this->price_normal='0.00';
        $this->price_emergency='0.00';
        $this->state='Activo';
        $this->grupo='Elegir';
        $this->selected_id = null;
        $this->action = 1;
        $this->search = '';
    }

    public function edit($id)
    {
        $record = Examen::find($id);
        $this->selected_id = $id;
        $this->name = $record->name;
        $this->method = $record->method;
        $this->price_normal = $record->price_normal;
        $this->price_emergency = $record->price_emergency;
        $this->state=$record->state;
        $this->grupo = $record->grupo;
        $this->action=2;
    }


    public function StoreOrUpdate()
    {
        $this->validate([
            'grupo' => 'not_in:Elegir',
            'name' => 'required',
            'price_normal' => 'required',
            'price_emergency' => 'required',
            'state' => 'required',
            
        ]);

        if($this->selected_id <= 0)
        {    
            $examen = Examen::create([
                'name' => $this->name,
                'method' => $this->method,
                'price_normal' => $this->price_normal,
                'price_emergency' => $this->price_emergency,
                'state' => $this->state,
                'grupo' => $this->grupo,
            ]);
        } 
        else{
            $record = Examen::find($this->selected_id);
            $record-> update([
                'name' => $this->name,
                'method' => $this->method,
                'price_normal' => $this->price_normal,
                'price_emergency' => $this->price_emergency,
                'state' => $this->state,
                'grupo' => $this->grupo,
            ]);
        }
        if($this->selected_id)
            $this->emit('msgok', 'Examen Actualizado con Exito');
        else
            $this->emit('msgok', 'Examen Creado con Exito');
        $this->resetInput();
    }
    public function destroy($id)
    { 
        $tienesubgrupos = Subgrupoexamen::where('examen',$id)->get();
        if($tienesubgrupos->count() > 0){
            $this->emit('msg-error', 'El Examen que quiere eliminar tiene subgrupos registrados');
        }
        else 
        if ($id) {
            $record = Examen::where('id', $id);
            $record->delete();
            $this->resetInput();
            $this->emit('msgok', 'Examen eliminado con Exito');
        }
    }

    //listeners / escuchamos evento y ejecutar acciones
    protected $listeners = [
        'deleteRow' => 'destroy'
    ];
}