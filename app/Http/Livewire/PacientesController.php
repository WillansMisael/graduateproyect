<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Paciente;
use App\Models\Institucion;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;


class PacientesController extends Component
{
    use WithPagination;
    use HasRoles;
    protected $paginationTheme='bootstrap';
    
    public $cod_inst='Elegir',
    $name,
    $last_name,
    $nro_ci,
    $date_nac,
    $sex='Masculino',
    $direction,
    $telephone,
    $cel,
    $email,
    $state='Activo',
    $instituciones;

    //
    public $selected_id, $search;
    public $action=1, $pagination = 10;
    //
    protected $messages = [
        'name.required' => 'El nombre del paciente es requerido.',
        'name.string' => 'El nombre del paciente no debe contener números.',
        'last_name.required' => 'El apellido del paciente es requerido.',
        'last_name.string' => 'El apellido del paciente no debe contener números.',
        'cel.min' => 'El celular debe contener 8 dígitos',
        'cel.max' => 'El celular debe contener 8 dígitos',
        'nro_ci.required' => 'El numero de ci es requerido.',
        'nro_ci.min' => 'El Ci debe tener al menos 7 dígitos',
        'nro_ci.max' => 'El  Ci no debe tener mas de 12 dígitos',
        'date_nac.required' => 'La fecha de nacimiento es requerido.',
    ];
   
    public function render()
    {
        //llenar el select
        $this->instituciones = Institucion::where('state','Activo')->get();
        if(strlen($this->search) > 0){
            $info = Paciente::leftjoin('instituciones as i','i.id','pacientes.cod_inst')
            ->select('pacientes.*','i.name as cod_inst')
            ->where('pacientes.nro_ci','like','%'. $this->search.'%')
            ->orwhere('pacientes.name','like','%'. $this->search.'%')
            ->orwhere('pacientes.last_name','like','%'. $this->search.'%')
            ->paginate($this->pagination);
            return view('livewire.pacientes.component',[
                'info'=>$info,

            ]);
        }
        else{
            $info = Paciente::leftjoin('instituciones as i','i.id','pacientes.cod_inst')
            ->select('pacientes.*','i.name as cod_inst')
            ->orderBy('pacientes.id', 'asc')
            ->paginate($this->pagination);
            return view('livewire.pacientes.component',[
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
        $this->last_name = '';
        $this->nro_ci = '';
        $this->cod_inst='Elegir';
        $this->date_nac = '';
        $this->sex='Masculino';
        $this->direction = '';
        $this->telephone = '';
        $this->cel = '';
        $this->email = '';
        $this->state='Activo';
        $this->selected_id = null;
        $this->action = 1;
        $this->search = '';
    }

    public function edit($id)
    {
        $record = Paciente::find($id);
        $this->selected_id = $id;
        $this->name = $record->name;
        $this->last_name = $record->last_name;
        $this->nro_ci = $record->nro_ci;
        $this->date_nac = $record->date_nac;
        $this->sex=$record->sex;
        $this->direction = $record->direction;
        $this->telephone = $record->telephone;
        $this->cel = $record->cel;
        $this->state=$record->state;
        $this->cod_inst = $record->cod_inst;
        $this->action=2;
    }
    public function StoreOrUpdate()
    {
        $this->validate([
            'name' => 'required|string',
            'cod_inst' => 'not_in:Elegir',
            'last_name' => 'required|string',
            'nro_ci' => 'required|min:7|max:12',
            'date_nac' => 'required',
            'sex' => 'required',
            'state' => 'required',  
            'cel' => 'min:8|max:8',  
        ]);
        
        try {
            //code...
            if($this->selected_id <= 0)
            {    
                if($this->email == ''){
                    $password = str_replace(' ', '',$this->name.$this->last_name);
                    $user = User::create([
                        'email'=>'sin email '.$this->name.' '.$this->last_name,
                        'password'=>Hash::make($password)
                    ]);
                }else{
                    $user = User::create([
                        'email'=>$this->email,
                        'password'=>Hash::make($this->nro_ci)
                    ]);
                }
                            $paciente = Paciente::create([
                                'name' => $this->name,
                                'last_name' => $this->last_name,
                                'nro_ci' => $this->nro_ci,
                                'date_nac' => $this->date_nac,
                                'sex' => $this->sex,
                                'direction' => $this->direction,
                                'telephone' => $this->telephone,
                                'cel' => $this->cel,
                                'state' => $this->state,
                                'cod_inst' => $this->cod_inst,
                                'user' => $user->id,
                                ]);
                                $user->assignRole('Paciente');
                            }
                    
                    else{
                        $record = Paciente::find($this->selected_id);
                        $record-> update([
                            'name' => $this->name,
                            'last_name' => $this->last_name,
                            'nro_ci' => $this->nro_ci,
                            'date_nac' => $this->date_nac,
                            'sex' => $this->sex,
                            'direction' => $this->direction,
                            'telephone' => $this->telephone,
                            'cel' => $this->cel,
                            'state' => $this->state,
                            'cod_inst' => $this->cod_inst,
                            ]);
                        }
                    } 
                    catch (\Exception $e) {
                        dd($e);
                     }
        if($this->selected_id)
            $this->emit('msgok', 'Paciente Actualizado con Exito');
        else
            $this->emit('msgok', 'Paciente Creado con Exito');
        $this->resetInput();
    }
    public function destroy($id)
    {
        $pacientesolicitud = Solicitud::where('pacient',$id)->get();
        $paciente = Paciente::where('id', $id)->select('user')->get();
        $user = User::where('id',$paciente);
        //dd($user);
        if($pacientesolicitud->count() > 0){
            $this->emit('msg-error', 'El paciente que quiere eliminar tiene solicitudes registradas');
        }
        else if($id){
            $record = Paciente::where('id', $id);
            $record->delete();
            $user->delete();
            $this->resetInput();
            $this->emit('msgok', 'Paciente eliminado con Exito');
        }
    }
    public function PDF()
    {
        $pacientes = Paciente::leftjoin('instituciones as i','i.id','pacientes.cod_inst')
                        ->select('pacientes.*','i.name as cod_inst')->get();

       $pdf = PDF::loadView('livewire.pacientes.pdf',
       ['info' => $pacientes,
       ])->output();
       return response()->streamDownload(
          fn() => print($pdf),
          'pacientes-lab-'.Carbon::now()->format('Y-m-d').'.pdf'
       );

    }
    //listeners / escuchamos evento y ejecutar acciones
    protected $listeners = [
        'deleteRow' => 'destroy',
        'PDF' => 'PDF'

    ];

}
