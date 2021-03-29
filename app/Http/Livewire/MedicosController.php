<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Examen;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;

class MedicosController extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';
    public
    $name,
    $last_name,
    $sex='Masculino',
    $cel,
    $speciality,
    $email,
    $state='Activo';

    public $selected_id, $search;
    public $action=1, $pagination = 10;

    protected $messages = [
        'name.required' => 'El nombre del medico es requerido.',
        'name.string' => 'El nombre del medico no debe contener números.',
        'last_name.required' => 'El apellido del medico es requerido.',
        'last_name.string' => 'El apellido del medico no debe contener números.',
        'cel.min' => 'El celular debe contener 8 dígitos',
        'cel.max' => 'El celular debe contener 8 dígitos',
    ];

    public function render()
    {
        //vemos si estan buscando algo y hacemos la busqueda en la tabla para retornarlo
        if(strlen($this->search) > 0)
        {
            $info = Medico::where('name', 'like', '%' .  $this->search . '%')
            ->orwhere('last_name', 'like', '%' .  $this->search . '%')
            ->paginate(5);
            return view('livewire.medicos.component',[
                'info'=>$info,
            ]);
        }else {
            // caso contrario solo retornamos el componente inyectado con 5 registros
               return view('livewire.medicos.component', [
                'info' => Medico::paginate($this->pagination),
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
        $this->sex = 'Masculino';
        $this->cel = '';
        $this->speciality = '';
        $this->state = 'Activo';
        $this->email = '';
        $this->selected_id = null;
        $this->action = 1;
        $this->search = '';
    }
    public function edit($id)
    {
        $record = Medico::find($id);
        $this->selected_id = $id;
        $this->name = $record->name;
        $this->last_name = $record->last_name;
        $this->sex = $record->sex;
        $this->cel = $record->cel;
        $this->speciality = $record->speciality;
        $this->state = $record->state;
        $this->action = 2;
    }
    public function StoreOrUpdate()
    {
        //validar campos requeridos
        $this->validate([
            'name' => 'required|string',
            'last_name' => 'required|string',
            'cel' => 'min:8|max:8',
        ]);

        if($this->selected_id <= 0)
        {   
                if($this->email == ''){
                    $password = str_replace(' ', '',$this->name.$this->last_name);
                    $user = User::create([
                        'email'=>'sin email '.$this->name.' '.$this->last_name,
                        'password'=>Hash::make($password)
                    ]);
                }else{
                    $password = str_replace(' ', '',$this->name.$this->last_name);
                    $user = User::create([
                        'email'=>$this->email,
                        'password'=>Hash::make($password)
                    ]);
                }
                
                $medico = Medico::create([
                    'name' => $this->name,
                    'last_name' => $this->last_name,
                    'sex' => $this->sex,
                    'cel' => $this->cel,
                    'speciality' => $this->speciality,
                    'state' => $this->state,
                    'user' => $user->id,
                ]);
                $user->assignRole('Medico');
                $pacientes = Paciente::where('state', 'Activo')->get();
                $medicos = Medico::where('state', 'Activo')->get();
                $examenes = Examen::where('state', 'Activo')->get();
        } 
        else{
            $record = Medico::find($this->selected_id);
            $record-> update([
                'name' => $this->name,
                'last_name' => $this->last_name,
                'sex' => $this->sex,
                'cel' => $this->cel,
                'speciality' => $this->speciality,
                'state' => $this->state,
            ]);
        }
        if($this->selected_id)
            $this->emit('msgok', 'Medico Actualizado con Exito');
        else
            $this->emit('msgok', 'Medico Creado con Exito');
        $this->resetInput();
    }
    public function destroy($id)
    {
        $medicosolicitud = Solicitud::where('medic',$id)->get();
        if($medicosolicitud->count() > 0){
            $this->emit('msg-error', 'El médico que quiere eliminar tiene solicitudes registradas');
        }
        else if ($id) {
            $record = Medico::where('id', $id);
   
            $record->delete();

            $this->resetInput();
            $this->emit('msgok', 'Médico eliminado con Exito');
        }
    }
    public function PDF()
    {

       $pdf = PDF::loadView('livewire.medicos.pdf',
       ['info' => Medico::all(),
       ])->output();
       return response()->streamDownload(
          fn() => print($pdf),
          'medicos-lab-'.Carbon::now()->format('Y-m-d').'.pdf'
       );

    }
    //listeners / escuchamos evento y ejecutar acciones
    protected $listeners = [
        'deleteRow' => 'destroy',
        'PDF' => 'PDF'
    ];
}
