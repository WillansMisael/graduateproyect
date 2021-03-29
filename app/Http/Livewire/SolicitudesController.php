<?php
// ------------------------------------------  antiguo ------------------------------------------
namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Grupo;
use App\Models\Examen;
use App\Models\Exp;
use App\Models\Solicitud;
use Carbon\Carbon;
use DB;

class SolicitudesController extends Component
{
    //usar paginacion
    use WithPagination;
    public $grupos;
    public $examenes;
    //prueba
    public $examsolicitados;
    public $id_sol;
    public $precio_normal;
    public $total;

    //


    public $selectedGrupo = null;
    public $selectedExamen = null;
    //propiedades
    public $selected_id, $search, $buscarPaciente, $buscarMedico, $obj, $pacientes,$medicos, $medicoSelected, $pacienteSelected;
    public $name, $last_name, $nro_ci;
    public $mname, $mlast_name, $speciality;
    private $pagination = 5, $section = 1;

    public function mount()
    {
        //lab
        $this->grupos = Grupo::all();
        $this->examenes = collect();
        $this->examsolicitados = collect();
    }

    public function render()
    {
        //buscar paciente;
        $pacientes = null;
        if (strlen($this->buscarPaciente) > 0) {
            $pacientes = Paciente::select('*')->where('nro_ci','like','%'.$this->buscarPaciente.'%')
                        ->orwhere('name','like','%'.$this->buscarPaciente.'%')
                        ->orwhere('last_name','like','%'.$this->buscarPaciente.'%')->get();
        }
        $this->pacientes = $pacientes;

        //buscar medico;
        $medicos = null;
        if (strlen($this->buscarMedico) > 0) {
            $medicos = Medico::select('*')->where('speciality','like','%'.$this->buscarMedico.'%')
                        ->orwhere('name','like','%'.$this->buscarMedico.'%')
                        ->orwhere('last_name','like','%'.$this->buscarMedico.'%')->get();
        }
        $this->medicos = $medicos;
        $this->examsolicitados = Exp::select('id_sol','id_ex','id_gru','e.price_normal','e.name as examen','g.name as grupo')
        ->leftjoin('grupos as g','g.id','exp.id_gru')
        ->leftjoin('examenes as e','e.id','exp.id_ex')
        ->where('id_sol',$this->id_sol)->get();



        return view('livewire.solicitudes.component');
    }

    public function mostrarPaciente($paciente){
        $this->pacientes = '';
        $this->buscarPaciente = '';
        //decodificamos el json que enviamos
        $pacienteJson = json_decode($paciente);

        $this->name = $pacienteJson->name;
        $this->last_name = $pacienteJson->last_name;
        $this->nro_ci = $pacienteJson->nro_ci;
        $this->pacienteSelected = $pacienteJson->id;
    }

    public function mostrarMedico($medico){
        $this->medicos = '';
        $this->buscarMedico = '';
        //decodificamos el json que enviamos
        $medicoJson = json_decode($medico);
        //dd($medicoJson);
        $this->mname = $medicoJson->name;
        $this->mlast_name = $medicoJson->last_name;
        $this->speciality = $medicoJson->speciality;
        $this->medicoSelected = $medicoJson->id;
        
    }
    public function updatedSelectedGrupo($grupo)
    {
        $this->examenes = Examen::where('grupo', $grupo)->get();
        $this->reset('selectedExamen');
    }
    public function ns(){

        $sol = Solicitud::create([
            'paciente' => $this->pacienteSelected,
            'medico' => $this->medicoSelected,
            'total' => 10
        ]);
        $this->id_sol=$sol->id;
        $ver=$this->pacienteSelected.' '.$this->medicoSelected.' '.$this->id_sol;
    }
    public function add()
    {
       
        $exist = DB::select('select * from exp where id_sol = ? and id_ex = ?', [$this->id_sol,$this->selectedExamen]);

        if($exist != null){
            $this->emit('msg-error', 'El examen ya esta agregado');
            $this->reset('selectedExamen');
            $this->reset('selectedGrupo');
        }else{
            
       $examensolicitud = Exp::create([
            'id_sol'=>$this->id_sol,
            'id_gru' => $this->selectedGrupo,
            'id_ex' => $this->selectedExamen
        ]);
        
        
        
        $this->total = Exp::leftjoin('examenes as e','e.id','exp.id_ex')->where('id_sol', $this->id_sol)->sum('price_normal');
        
        $cm = Solicitud::where('id',$this->id_sol)->get();

        $cm->toQuery()->update([
            'total' => $this->total,
        ]);
        $this->reset('selectedExamen');
        $this->reset('selectedGrupo');
        $this->selectedExamen = NULL;
        $this->selectedGrupo = NULL;
        }
    }
    public function borrar($id)
    {
        //seleccionamos el examen
        $idexp = DB::select('select * from exp where id_sol = ? and id_ex = ?', [$this->id_sol,$id]);
        $examenexist=Exp::where('id_sol',$this->id_sol)->where('and id',$idexp->id)->where('and id_ex',$id)->delete();
        $examenexist->delete();
    }

}
