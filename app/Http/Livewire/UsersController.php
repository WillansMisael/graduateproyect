<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\User;
use App\Models\Medico;
use App\Models\Personal;
use App\Models\Paciente;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;


class UsersController extends Component
{
	use WithPagination;
    protected $paginationTheme='bootstrap';

	//properties
	public  $email,$password;
	public  $selected_id, $search;   						
    public  $action = 1;             						
    private $pagination = 10;         						

    public function render()
    {
		$recordspe = Personal::count();
		$recordsme = Medico::count();
		$recordspa = Paciente::count();

    	if(strlen($this->search) > 0)
    	{
			$paciente = User::join('pacientes as pa','pa.user','users.id')		
				->select('pa.name as npa','pa.last_name as lnpa','users.*')
				->where('pa.name','like','%'. $this->search.'%')
            	->orwhere('pa.last_name','like','%'. $this->search.'%')
            	->orwhere('users.email','like','%'. $this->search.'%')
				->paginate($this->pagination);
			$medico = User::join('medicos as me','me.user','users.id')
				->select('me.name as nm','me.last_name as lnm', 'users.*')
            	->where('me.name','like','%'. $this->search.'%')
            	->orwhere('me.last_name','like','%'. $this->search.'%')
            	->orwhere('users.email','like','%'. $this->search.'%')
				->paginate(100);
			$personal = User::join('personal as pe','pe.user','users.id')			
				->select('pe.name as npe','pe.last_name as lnpe','users.*')
            	->where('pe.name','like','%'. $this->search.'%')
            	->orwhere('pe.last_name','like','%'. $this->search.'%')
            	->orwhere('users.email','like','%'. $this->search.'%')
				->paginate(100);
    		return view('livewire.users.component', [
				'personal' => $personal,
    			'medico' => $medico,
				'paciente' => $paciente,
				'recordspe' => $recordspe,'recordsme' => $recordsme,'recordspa' => $recordspa
    		]);
    	}
    	else {
			
			if ($recordspa > 0) {
				$paciente = User::join('pacientes as pa','pa.user','users.id')		
				->select('pa.name as npa','pa.last_name as lnpa','users.*')
            	->orderBy('users.id', 'asc')
    			->paginate($this->pagination);
			}else{
				$paciente = 'No se tienen Pacientes registrados';
			}
    		
			if ($recordsme > 0) {
				$medico = User::join('medicos as me','me.user','users.id')
				->select('me.name as nm','me.last_name as lnm', 'users.*')
            	->orderBy('users.id', 'asc')
				->paginate(100);
			}else{
				$medico = 'No se tienen Medicos registrados';
			}
			
			if ($recordspe > 0) {
				$personal = User::join('personal as pe','pe.user','users.id')			
				->select('pe.name as npe','pe.last_name as lnpe','users.*')
            	->orderBy('users.id', 'asc')
				->paginate(100);
			}else {
				$personal = 'No se tienen Personal registrados';
			}
			
			
    		return view('livewire.users.component', [
				'personal' => $personal,
    			'medico' => $medico,
				'paciente' => $paciente,
				'recordspe' => $recordspe,'recordsme' => $recordsme,'recordspa' => $recordspa
				
    		]);
    	}
    }

    //permite la búsqueda cuando se navega entre el paginado
    public function updatingSearch()
    {
    	$this->gotoPage(1);
    }

    //activa la vista edición o creación
    public function doAction($action)
    {
    	$this->resetInput();
    	$this->action = $action;

    }

	//método para reiniciar variables
    private function resetInput()
    {
    
    	$this->email = '';
    	$this->password = '';
    	$this->selected_id = null;       
    	$this->action = 1;
    	$this->search = '';

    }

    //buscamos el registro seleccionado y asignamos la info a las propiedades
    public function edit($id)
    {
    	$record = User::findOrFail($id);
    	$this->selected_id = $id;
    	$this->email = $record->email;
    	$this->action = 2;

    }


    //método para registrar y/o actualizar registros
    public function StoreOrUpdate()
    {         	

    	$this->validate([
    		'password'  => 'required',
    		'email'   => 'required|email',
    	]);    	


    	if($this->selected_id <= 0) {        

    		$user =  User::create([
    			'email' => $this->email,
    			'password' => bcrypt($this->password)
    		]);


    	}
    	else 
    	{

    		$user = User::find($this->selected_id);
    		$user->update([
    			'email' => $this->email,
    			'password' => bcrypt($this->password)
    		]);                    


    	}
    	

    	if($this->selected_id) 
    		 $this->emit('msgok', 'Usuario Actualizado');
    	else
    		 $this->emit('msgok', 'Usuario Creado');


    	$this->resetInput();
    }


    //escuchar eventos y ejecutar acción solicitada
    protected $listeners = [
		'deleteRow'     => 'destroy',
 
    ];  


   //método para eliminar un registro dado
    public function destroy($id)
    {
 			$recordspe = Personal::where('user', $id)->count();
			$recordsme = Medico::where('user', $id)->count();
			$recordspa = Paciente::where('user', $id)->count();
   			 if($recordspe > 0 || $recordsme > 0 || $recordspa > 0){
    		 $this->emit('msg-error', "No es posible eliminar las credenciales por que el usuario aun existe");      
    		}
     		else {
    		$user = User::where('id', $id);
    		$user->delete();
    		$this->resetInput();
            $this->emit('msgok', "Usuario eliminado de sistema");  
        }
    }

		public function PDF()
		{
			$user = User::leftjoin('pacientes as p','p.user','users.id')
						->leftjoin('medicos as m','m.user','users.id')
						->leftjoin('personal as pe','pe.user','users.id')
						->get();
				dd($user);		
		   $pdf = PDF::loadView('livewire.users.pdf',
		   ['info' => $user,
		   ])->output();
		   return response()->streamDownload(
			  fn() => print($pdf),
			  'instituciones-lab-'.Carbon::now()->format('Y-m-d').'.pdf'
		   );
	
		}
 
}
