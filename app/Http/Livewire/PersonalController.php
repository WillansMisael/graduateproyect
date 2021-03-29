<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Personal;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;

class PersonalController extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';
    
    public 
    $name,
    $last_name,
    $cargo,
    $nro_ci,
    $date_nac,
    $sex='Masculino',
    $direction,
    $email,
    $cel,
    $state='Activo';

    //
    public $selected_id, $search;
    public $action=1, $pagination = 5;
    //
    protected $messages = [
        'name.required' => 'El nombre del personal es requerido.',
        'name.string' => 'El nombre del personal no debe contener números.',
        'last_name.required' => 'El apellido del personal es requerido.',
        'last_name.string' => 'El apellido del personal no debe contener números.',
        'cel.required' => 'El número de celular es requerido',
        'cel.min' => 'El celular debe contener 8 dígitos',
        'cel.max' => 'El celular debe contener 8 dígitos',
        'nro_ci.required' => 'El número de ci es requerido.',
        'direction.required' => 'La direccion de referencia es requerida.',
        'nro_ci.min' => 'El Ci debe tener al menos 7 dígitos',
        'nro_ci.max' => 'El  Ci no debe tener mas de 12 dígitos',
        'date_nac.required' => 'La fecha de nacimiento es requerida.',
    ];

    public function render()
    {
        //vemos si estan buscando algo y hacemos la busqueda en la tabla para retornarlo
        if(strlen($this->search) > 0)
        {
            $info = Personal::where('name', 'like', '%' .  $this->search . '%')
            ->orwhere('last_name', 'like', '%' .  $this->search . '%')
            ->orwhere('nro_ci', 'like', '%' .  $this->search . '%')
            ->paginate(5);
            return view('livewire.personal.component',[
                'info'=>$info,
            ]);
        }else {
            // caso contrario solo retornamos el componente inyectado con 5 registros
               return view('livewire.personal.component', [
                'info' => Personal::paginate(5),
            ]);
           }
    }
    // para busquedas con paginacion
    public function updatingSearch()
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
        $this->last_name = '';
        $this->cargo = '';
        $this->nro_ci = '';
        $this->date_nac = '';
        $this->sex='Masculino';
        $this->direction = '';
        $this->cel = '';
        $this->email = '';
        $this->state='Activo';
        $this->selected_id = null;
        $this->action = 1;
        $this->search = '';
    }
    public function edit($id)
    {
        
        $record = Personal::find($id);
        $this->selected_id = $id;
        $this->name = $record->name;
        $this->last_name = $record->last_name;
        $this->nro_ci = $record->nro_ci;
        $this->cargo = $record->cargo;
        $this->date_nac = $record->date_nac;
        $this->sex=$record->sex;
        $this->direction = $record->direction;
        $this->cel = $record->cel;
        $this->state=$record->state;
        $this->cod_inst = $record->cod_inst;
        $this->action=2;
    }
    public function StoreOrUpdate()
    {
        $this->validate([
            'name' => 'required',
            'last_name' => 'required',
            'nro_ci' => 'required',
            'date_nac' => 'required',
            'sex' => 'required',
            'state' => 'required',
            'cel' => 'required',
            'cargo' => 'required',
            'direction' => 'required',
            
        ]);

        if($this->selected_id <= 0)
        {   
            $existe = User::where('email', $this->email)->select('email')->get();
            if($existe->count() > 0) {
                $this->emit('msg-error', 'Ya existe otro registro con el mismo email');
                return;
            }else {  
                $user = User::create([
                    'email'=>$this->email,
                    'password'=>Hash::make($this->nro_ci)
                ]);
                $personal = Personal::create([
                    'name' => $this->name,
                    'last_name' => $this->last_name,
                    'nro_ci' => $this->nro_ci,
                    'cargo' => $this->cargo,
                    'date_nac' => $this->date_nac,
                    'sex' => $this->sex,
                    'direction' => $this->direction,
                    'cel' => $this->cel,
                    'state' => $this->state,
                    'user' => $user->id,
                ]);
                $user->assignRole('Personal');
            }
        } 
        else{
            $record = Personal::find($this->selected_id);
            $record-> update([
                'name' => $this->name,
                'last_name' => $this->last_name,
                'nro_ci' => $this->nro_ci,
                'cargo' => $this->cargo,
                'date_nac' => $this->date_nac,
                'sex' => $this->sex,
                'direction' => $this->direction,
                'cel' => $this->cel,
                'state' => $this->state,
            ]);
        }
        if($this->selected_id)
            $this->emit('msgok', 'Personal Actualizado con Exito');
        else
            $this->emit('msgok', 'Personal Creado con Exito');
        $this->resetInput();
    }
    public function destroy($id)
    {
        if ($id) {
            $record = Personal::where('id', $id);
            $record->delete();
            $this->resetInput();
            $this->emit('msgok', 'Personal eliminado con Exito');
        }
    }
    public function PDF()
    {
       $pdf = PDF::loadView('livewire.personal.pdf',
       ['info' => Personal::all(),
       ])->output();
       return response()->streamDownload(
          fn() => print($pdf),
          'personal-lab-'.Carbon::now()->format('Y-m-d').'.pdf'
       );

    }
    //listeners / escuchamos evento y ejecutar acciones
    protected $listeners = [
        'deleteRow' => 'destroy',
        'PDF' => 'PDF'
        
    ];
}
