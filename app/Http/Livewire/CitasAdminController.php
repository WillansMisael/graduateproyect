<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Cita;
use DB;

class CitasAdminController extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';

    public $search, $action=1, $pagination = 10;

    public function render()
    {
        if(strlen($this->search) > 0){
            $info = Cita::leftjoin('pacientes as p','p.user','citas.user')
            ->select('citas.*','p.name','p.last_name','p.nro_ci')
            ->where('p.name','like','%'. $this->search.'%')
            ->where('p.last_name','like','%'. $this->search.'%')
            ->orwhere('p.nro_ci','like',$this->search.'%')
            ->orwhere('citas.created_at','like',$this->search.'%')
            ->orwhere('citas.start','like',$this->search.'%')
            ->orwhere('citas.state','like',$this->search.'%')
            ->orwhere('citas.id','like',$this->search.'%')
            ->orderBy('citas.id','DESC')
            ->paginate($this->pagination);
            return view('livewire.citasadmin.component',[
                'info'=>$info,

            ]);
        }
        $info = Cita::leftjoin('pacientes as p','p.user','citas.user')
            ->select('citas.*','p.name','p.last_name','p.nro_ci')
            ->orderBy('citas.id', 'DESC')
            ->paginate($this->pagination);

            return view('livewire.citasadmin.component',[
                'info'=>$info,
            ]);
    }
    public function change_state($id)
    {
        $state = Cita::where('id',$id)->get();
        $record = Cita::where('id',$id);
        //dd($record);
        foreach ($state as $i) {
            $estado = $i->state;
        } 
        if ($estado == "SINCONFIRMAR") {
            $record->update(['state'=>'CONFIRMADO']);
            $this->emit('msgok', 'Cita confirmada');
        }else{
            $record->update(['state'=>'SINCONFIRMAR']);
            $this->emit('msg-warning', 'Cita sin confirmar');
        }
    }
     //eliminar registros
     public function destroy($id)
     {
         if($id){
             $record = Cita::where('id', $id);;
             $record->delete();
         }
     }

   
    protected $listeners = [
        'change_state' => 'change_state',
        'deleteRow' => 'destroy'
    ];
}
